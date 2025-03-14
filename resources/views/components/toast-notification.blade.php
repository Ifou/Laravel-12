<div
    x-data="{
        notifications: [],
        add(message, type = 'success') {
            const id = Date.now();
            this.notifications.push({
                id,
                message,
                type,
                progress: 100
            });
            
            const progressInterval = setInterval(() => {
                const notification = this.notifications.find(n => n.id === id);
                if (notification) {
                    notification.progress = notification.progress - 1;
                    if (notification.progress <= 0) {
                        clearInterval(progressInterval);
                        this.remove(id);
                    }
                }
            }, 30);
        },
        remove(id) {
            this.notifications = this.notifications.filter(notification => notification.id !== id);
        }
    }"
    @notify.window="add($event.detail.message, $event.detail.type)"
    class="fixed top-4 right-4 z-50 space-y-4"
>
    <template x-for="notification in notifications" :key="notification.id">
        <div
            x-show="notification"
            x-transition:enter="transform transition ease-out duration-500"
            x-transition:enter-start="translate-x-full opacity-0 -translate-y-4"
            x-transition:enter-end="translate-x-0 opacity-100 translate-y-0"
            x-transition:leave="transform transition ease-in duration-300"
            x-transition:leave-start="translate-x-0 opacity-100"
            x-transition:leave-end="translate-x-full opacity-0 -translate-y-4"
            class="min-w-[400px] max-w-xl w-full bg-white dark:bg-gray-800 shadow-lg rounded-lg pointer-events-auto ring-1 ring-black ring-opacity-5 overflow-hidden relative animate-fade-in"
        >
            <div class="p-4">
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <template x-if="notification.type === 'success'">
                            <svg class="h-6 w-6 text-green-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </template>
                        <template x-if="notification.type === 'error'">
                            <svg class="h-6 w-6 text-red-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9.344-4.125a9.375 9.375 0 11-18.75 0 9.375 9.375 0 0118.75 0zm-9.344 0a.375.375 0 00-.375.375v3.75a.375.375 0 00.375.375h.375a.375.375 0 00.375-.375V9.375a.375.375 0 00-.375-.375h-.375z" />
                            </svg>
                        </template>
                        <template x-if="notification.type === 'info'">
                            <svg class="h-6 w-6 text-blue-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                            </svg>
                        </template>
                    </div>
                    <div class="flex-1 pt-0.5">
                        <p class="text-sm font-medium text-gray-900 dark:text-white leading-5" x-text="notification.message"></p>
                    </div>
                    <div class="flex-shrink-0 flex">
                        <button
                            @click="remove(notification.id)"
                            class="rounded-md inline-flex text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        >
                            <span class="sr-only">Close</span>
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Progress bar -->
            <div 
                class="absolute bottom-0 left-0 right-0 h-1 bg-gray-100 dark:bg-gray-700"
            >
                <div
                    class="h-full transition-all duration-75 ease-linear"
                    :class="{
                        'bg-green-500': notification.type === 'success',
                        'bg-red-500': notification.type === 'error',
                        'bg-blue-500': notification.type === 'info'
                    }"
                    :style="{ width: notification.progress + '%' }"
                ></div>
            </div>
        </div>
    </template>
</div>
