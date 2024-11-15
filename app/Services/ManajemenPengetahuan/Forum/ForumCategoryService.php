<?php
namespace App\Services\ManajemenPengetahuan\Forum;

use App\Models\ManajemenPengetahuan\Forum\ForumCategory;

class ForumCategoryService
{
    public function getAllForumCategories()
    {
        $forum_categories = ForumCategory::all();
        return [
            'forum_categories' => $forum_categories
        ];
    }


    public function storeForumCategory(array $data)
    {
        $forumCategory = ForumCategory::create($data);

        return $forumCategory;
    }

    public function editForumCategory(int $id) {
        $forum_category = ForumCategory::findOrFail($id);

        return [
            'forum_category' => $forum_category,
        ];
    }

    public function updateForumCategory(array $data, int $id)
    {
        $forum_category = ForumCategory::findOrFail($id);
        $forum_category->update($data);

        return $forum_category;
    }

    public function deleteForumCategory(int $id)
    {
        $forum_category = ForumCategory::findOrFail($id);

        return $forum_category->delete();
    }
}