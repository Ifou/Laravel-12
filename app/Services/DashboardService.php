<?php

namespace App\Services;

use App\Models\User;
use App\Models\Post;
use App\Models\Cms;
use Illuminate\Support\Facades\Auth;

class DashboardService
{
    /**
     * Get user data for the dashboard
     */
    public function getUsersData(): array
    {
        $userCount = User::count();
        $currentUser = Auth::user();
        $currentUserId = $currentUser?->id;
        $onlineThreshold = now()->subMinutes(5);
        $colors = ['blue-400', 'blue-500', 'blue-600', 'indigo-500'];
        
        // Get up to 7 other users (excluding current user)
        // Order by last_seen_at but make sure null values (logged out) come last
        $users = User::when($currentUser, fn($q) => $q->where('id', '!=', $currentUserId))
            ->orderByRaw('CASE WHEN last_seen_at IS NULL THEN 0 ELSE 1 END DESC')
            ->orderBy('last_seen_at', 'desc')
            ->limit(7)
            ->get(['id', 'name', 'email', 'last_seen_at']);
        
        // Count online users
        $onlineCount = ($currentUser ? 1 : 0); // Current user is always considered online
        
        foreach ($users as $user) {
            if ($user->isOnline()) {
                $onlineCount++;
            }
        }
        
        // No need to add a closure for isOnline since we have the method in the model
        
        $visibleUsers = $users->count() + ($currentUser ? 1 : 0);
        $remainingCount = $userCount - $visibleUsers;
        
        return [
            'totalCount' => $userCount,
            'currentUser' => $currentUser,
            'users' => $users,
            'onlineCount' => $onlineCount, 
            'colors' => $colors,
            'remainingCount' => max(0, $remainingCount),
            'visibleCount' => $visibleUsers
        ];
    }
    
    /**
     * Get posts data for the dashboard
     */
    public function getPostsData(): array
    {
        $postCount = Post::count();
        
        // In a real app, you'd query your database for this data
        // For now we'll simulate it with some realistic values
        $draftCount = max(1, round($postCount * 0.2));
        $publishedCount = max(1, round($postCount * 0.6));
        $archivedCount = $postCount - $draftCount - $publishedCount;
        
        $categories = [
            [
                'name' => 'Draft',
                'count' => $draftCount,
                'percentage' => $postCount > 0 ? round(($draftCount / $postCount) * 100) : 0,
                'color' => 'emerald-200', 
                'darkColor' => 'emerald-700',
                'textColor' => 'emerald-800 dark:text-white',
                'height' => 20
            ],
            [
                'name' => 'Published',
                'count' => $publishedCount,
                'percentage' => $postCount > 0 ? round(($publishedCount / $postCount) * 100) : 0,
                'color' => 'emerald-400', 
                'darkColor' => 'emerald-500',
                'textColor' => 'white',
                'height' => 40
            ],
            [
                'name' => 'Archived',
                'count' => $archivedCount,
                'percentage' => $postCount > 0 ? round(($archivedCount / $postCount) * 100) : 0,
                'color' => 'emerald-600', 
                'darkColor' => 'emerald-600',
                'textColor' => 'white',
                'height' => 20
            ],
        ];
        
        return [
            'totalCount' => $postCount,
            'categories' => $categories,
        ];
    }
    
    /**
     * Get CMS data for the dashboard
     */
    public function getCmsData(): array
    {
        $cmsCount = Cms::count();
        
        $contentTypes = [
            [
                'name' => 'Text',
                'icon' => 'M5.25 8.25h13.5m-13.5 3.75h13.5m-13.5 3.75h13.5M12 17.25v-18',
                'count' => round($cmsCount * 0.4)
            ],
            [
                'name' => 'Image', 
                'icon' => 'M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z',
                'count' => round($cmsCount * 0.3)
            ],
            [
                'name' => 'Video', 
                'icon' => 'M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-3-5.25a.75.75 0 00-1.5 0v5.25H9.75a.75.75 0 000 1.5h7.5a.75.75 0 00.75-.75V6.75z',
                'count' => round($cmsCount * 0.2)
            ],
            [
                'name' => 'Form', 
                'icon' => 'M7.5 3.75H6A2.25 2.25 0 003.75 6v1.5M16.5 3.75H18A2.25 2.25 0 0120.25 6v1.5m0 9V18A2.25 2.25 0 0118 20.25h-1.5m-9 0H6A2.25 2.25 0 013.75 18v-1.5M15 12a3 3 0 11-6 0 3 3 0 016 0z',
                'count' => round($cmsCount * 0.1)
            ],
        ];
        
        return [
            'totalCount' => $cmsCount,
            'contentTypes' => $contentTypes,
        ];
    }
}
