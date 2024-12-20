<?php

namespace App\Services\IndikatorSPBE;

use App\Models\Article\Article;
use App\Models\Forum\ForumDiscussion;
use App\Models\IndikatorSPBE;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class IndikatorSPBEService
{

    public function getAllIndikators()
    {
        $indikators = IndikatorSPBE::with(['articles', 'forums'])->orderBy('date_added', 'desc')->paginate(10);

        $allArticles = Article::where('article_status', 'published')->get();
        $allForums = ForumDiscussion::where('approval_status', 'accepted')->orderBy('discussion_created_at', 'desc')->get();

        return [
            'indikators' => $indikators,
            'articles' => $allArticles,
            'forums' => $allForums,
        ];
    }

    public function storeIndikatorSPBE(array $data)
    {
        $fileName = null;
        $filePath = null;

        if (isset($data['related_documentation']) && $data['related_documentation']) {
            $fileName = Str::uuid() . '.' . $data['related_documentation']->getClientOriginalExtension();
            $filePath = $data['related_documentation']->storeAs('related_documentations', $fileName, 'public');
        }

        $indikator = IndikatorSPBE::create([
            'name' => $data['name'],
            'explanation' => $data['explanation'],
            'rule_information' => $data['rule_information'],
            'criteria' => $data['criteria'],
            'current_level' => $data['current_level_radio'] . " - " . $data['current_level'],
            'target_level' => $data['target_level_radio'] . " - " . $data['target_level'],
            'related_documentation' => $fileName,
            'person_in_charge' => $data['person_in_charge'],
            'date_added' => now(),
            'last_updated_date' => now(),
            'status' => 'active',
        ]);

        // Pivot table
        if (isset($data['articles']) && is_array($data['articles'])) {
            $indikator->articles()->sync($data['articles']);
        }

        if (isset($data['forums']) && is_array($data['forums'])) {
            $indikator->forums()->sync($data['forums']);
        }

        return $indikator;
    }

    public function showIndikatorSPBE(int $id)
    {
        $indikator = IndikatorSPBE::with(['articles', 'forums'])->findOrFail($id);

        return [
            'indikator' => $indikator
        ];
    }

    public function updateIndikatorSPBE(array $data, int $id)
    {
        $indikator = IndikatorSPBE::findOrFail($id);

        $fileName = $indikator->related_documentation ?? null;

        // Handle file upload
        if (isset($data['related_documentation'])) {
            // Delete old file
            if ($fileName && Storage::disk('public')->exists("related_documentations/$fileName")) {
                Storage::disk('public')->delete("related_documentations/$fileName");
            }

            $fileName = Str::uuid() . '.' . $data['related_documentation']->getClientOriginalExtension();
            $filePath = $data['related_documentation']->storeAs('related_documentations', $fileName, 'public');
        }

        $indikator->update([
            'name' => $data['name'],
            'explanation' => $data['explanation'],
            'rule_information' => $data['rule_information'],
            'criteria' => $data['criteria'],
            'current_level' => $data['current_level_radio'] . " - " . $data['current_level'],
            'target_level' => $data['target_level_radio'] . " - " . $data['target_level'],
            'related_documentation' => $fileName,
            'person_in_charge' => $data['person_in_charge'],
            'last_updated_date' => now(),
            'status' => 'active',
        ]);

        // Pivot table
        if (isset($data['articles'])) {
            $indikator->articles()->sync($data['articles']);
        } else {
            $indikator->articles()->sync($data['articles'] ?? []);
        }

        if (isset($data['forums'])) {
            $indikator->forums()->sync($data['forums']);
        } else {
            $indikator->forums()->sync($data['forums'] ?? []);
        }

        return $indikator;
    }

    public function deleteIndikatorSPBE($id)
    {
        $indikator = IndikatorSPBE::findOrFail($id);

        // Hapus file dari storage
        if ($indikator->related_documentation && Storage::disk('public')->exists("related_documentations/$indikator->related_documentation")) {
            Storage::disk('public')->delete("related_documentations/$indikator->related_documentation");
        }

        return $indikator->delete();
    }
}
