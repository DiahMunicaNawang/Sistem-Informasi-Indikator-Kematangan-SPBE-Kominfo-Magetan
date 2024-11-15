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

    public function editForumCategory($id) {
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

    public function deleteForumCategory($id)
    {
        $forum_category = ForumCategory::findOrFail($id);

        return $forum_category->delete();
    }
}