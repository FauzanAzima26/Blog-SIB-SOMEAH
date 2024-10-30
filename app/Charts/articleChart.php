<?php

namespace App\Charts;

use App\Models\Article;
use marineusde\LarapexCharts\Charts\RadialBarChart as OriginalRadialBarChart;

class articleChart
{
    public function build(): OriginalRadialBarChart
    {
        $user = auth()->user();

        if (auth()->user()->hasRole('owner')) {
            // owner
            $total = Article::where('published', true)->count();
            $unConfirm = Article::where('is_confirm', false)->count();
            $teknologi = Article::where('category_id', 10025)->count();
            $berita = Article::where('category_id', 10027)->count();
            $olahraga = Article::where('category_id', 10028)->count();

        }elseif (auth()->user()->hasRole('writer')) {
            // writer
            $total = Article::where('published', true)->where('user_id', $user->id)->count();
            $unConfirm = Article::where('is_confirm', false)->where('user_id', $user->id)->count();
            $teknologi = Article::where('category_id', 10025)->where('user_id', $user->id)->count();
            $berita = Article::where('category_id', 10027)->where('user_id', $user->id)->count();
            $olahraga = Article::where('category_id', 10028)->where('user_id', $user->id)->count();
        }

        return (new OriginalRadialBarChart)
            ->setTitle('Statistik data articel')
            ->addData([$total, $unConfirm, $teknologi, $berita, $olahraga])
            ->setLabels(['Total artikel', 'Artikel belum dikonfirmasi', 'Artikel teknologi', 'Artikel berita', 'Artikel olahraga'])
            ->setColors(['#D32F2F', '#03A9F4', '#4CAF50', '#FF9800', '#9C27B0']);
    }
}
