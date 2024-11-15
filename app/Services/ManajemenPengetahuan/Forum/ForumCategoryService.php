<?php
namespace App\Services\ManajemenPengetahuan\Forum;

use App\Models\ManajemenPengetahuan\Forum\ForumCategory;

class ForumCategoryService
{
    public function getAllForumCategories()
    {
        $data = ForumCategory::all();
        return $data;
    }


    public function storeForumCategory(array $data)
    {
        $forumCategory = ForumCategory::create($data);

        return $forumCategory;
    }

    public function editForumCategory(ForumCategory $forumCategory) {
        return [
            'forum_category' => $forumCategory,
        ];
    }

    public function updateForumCategory(ForumCategory $forumCategory, array $data)
    {
        $forumCategory->update($data);

        return $forumCategory;
    }

    public function deleteForumCategory(ForumCategory $forumCategory)
    {
        return $forumCategory->delete();
    }
}