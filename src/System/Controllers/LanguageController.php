<?php

namespace AvoRed\Framework\System\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use AvoRed\Framework\Database\Contracts\LanguageModelInterface;
use AvoRed\Framework\Database\Models\Language;
use AvoRed\Framework\System\Requests\LanguageRequest;

class LanguageController extends Controller
{
    /**
     * Language Repository for the Install Command
     * @var \AvoRed\Framework\Database\Repository\LanguageRepository $languageRepository
     */
    protected $languageRepository;
    
    /**
     * Construct for the AvoRed install command
     * @param \AvoRed\Framework\Database\Repository\LanguageRepository $languageRepository
     */
    public function __construct(
        LanguageModelInterface $languageRepository
    ) {
        $this->languageRepository = $languageRepository;
    }
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $languages = $this->languageRepository->all();
        
        return view('avored::system.language.index')
            ->with('languages', $languages);
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('avored::system.language.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param \AvoRed\Framework\System\Requests\LanguageRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(LanguageRequest $request)
    {
        $this->languageRepository->create($request->all());

        return redirect()->route('admin.language.index')
            ->with('successNotification', __('avored::system.notification.store', ['attribute' => 'Language']));
    }

    /**
     * Show the form for editing the specified resource.
     * @param \AvoRed\Framework\Database\Models\Language $language
     * @return \Illuminate\Http\Response
     */
    public function edit(Language $language)
    {
        return view('avored::system.language.edit')
            ->with('language', $language);
    }

    /**
     * Update the specified resource in storage.
     * @param \AvoRed\Framework\System\Requests\LanguageRequest $request
     * @param \AvoRed\Framework\Database\Models\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function update(LanguageRequest $request, Language $language)
    {
        $language->update($request->all());

        return redirect()->route('admin.language.index')
            ->with('successNotification', __('avored::system.notification.updated', ['attribute' => 'Language']));
    }

    /**
     * Remove the specified resource from storage.
     * @param \AvoRed\Framework\Database\Models\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function destroy(Language $language)
    {
        $language->delete();

        return [
            'success' => true,
            'message' => __('avored::system.notification.delete', ['attribute' => 'Language'])
        ];
    }
}