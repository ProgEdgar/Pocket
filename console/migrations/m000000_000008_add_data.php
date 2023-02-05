<?php

use yii\db\Migration;

/**
 * Class m000000_000008_add_data
 */
class m000000_000008_add_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        // API FOR MANGA
        $this->insert('{{%api}}', [
            'Name' => 'Jikan',
            'Link' => 'https://api.jikan.moe/v4/manga',
            'IsAnime' => false,
            'GenresAll' => 'https://api.jikan.moe/v4/genres/manga',
            'GenresId' => '[data][mal_id]',
            'GenresName' => '[data][name]',
            'SearchPage' => 'page',
            'SearchTotal' => '[pagination][items][total]',
            'SearchLimit' => 'limit',
            'SearchName' => 'q',
            'SearchWGenres' => 'genres=>,',
            'SearchWOutGenres' => 'genres_exclude=>,',
            'SearchOrderBy' => 'order_by',
            'SearchSortBy' => 'sort',
            'AMSearchLink' => 'https://api.jikan.moe/v4/manga',
            'AMLink' => 'https://api.jikan.moe/v4/manga/{am_id}',
            'AMId' => '[data][mal_id]',
            'AMTitle' => '[data][title]',
            'AMAlternativeTitle' => '[data][title_english]',
            'AMOriginalTitle' => '[data][title_japanese]',
            'AMStatus' => '[data][status]',
            'AMStatusOptions' => '[publishing=>Publishing=>Ongoing][complete=>Finished=>Completed][hiatus=>On Hiatus=>On Hold][discontinued=>Discontinued=>Stoped][upcoming=>Not yet published=>Upcoming]',
            'AMOrderByOptions' => '[title=>Title][start_date=>Release Date][popularity=>Popular]',
            'AMSortByOptions' => '[asc=>Ascendent][desc=>Descendent]',
            'AMType' => '[data][type]',
            'AMTypeOptions' => '[manga=>Manga][novel=>Novel][lightnovel=>Light Novel][oneshot=>One-shot][doujin=>Doujinshi][manhwa=>Manhwa][manhua=>Manhua]',
            'AMGenre' => '[data][genres]',
            'AMGenreName' => '[data][genres][name]',
            'AMReleaseDate' => '[data][aired][from]',
            'AMImage' => '[data][images][jpg][large_image_url]',
            'AMRating' => null,
            'AMRatingOptions' => null,
            'AMDescription' => '[data][synopsis]',
            'AMAuthor' => '[data][authors]',
            'AMAuthorName' => '[data][authors][name]',
            'AMCEQuantity' => '[data][chapters]',
            'CELink' => null,
            'CEId' => null,
            'CENumber' => null,
            'CEReleaseDate' => null,
            'CETitle' => null,
            'CESeason' => null,
        ]);

        //API FOR ANIME
        $this->insert('{{%api}}', [
            'Name' => 'Jikan',
            'Link' => 'https://api.jikan.moe/v4/anime',
            'IsAnime' => true,
            'GenresAll' => 'https://api.jikan.moe/v4/genres/anime',
            'GenresId' => '[data][mal_id]',
            'GenresName' => '[data][name]',
            'SearchPage' => 'page',
            'SearchTotal' => '[pagination][items][total]',
            'SearchLimit' => 'limit',
            'SearchName' => 'q',
            'SearchWGenres' => 'genres=>,',
            'SearchWOutGenres' => 'genres_exclude=>,',
            'SearchOrderBy' => 'order_by',
            'SearchSortBy' => 'sort',
            'AMSearchLink' => 'https://api.jikan.moe/v4/anime',
            'AMLink' => 'https://api.jikan.moe/v4/anime/{am_id}',
            'AMId' => '[data][mal_id]',
            'AMTitle' => '[data][title]',
            'AMAlternativeTitle' => '[data][title_english]',
            'AMOriginalTitle' => '[data][title_japanese]',
            'AMStatus' => '[data][status]',
            'AMStatusOptions' => '[airing=>Currently Airing=>Ongoing][complete=>Finished Airing=>Completed][upcoming=>Not Yet Aired=>Upcoming]',
            'AMOrderByOptions' => '[title=>Title][start_date=>Date][popularity=>Popular]',
            'AMSortByOptions' => '[asc=>Ascendent][desc=>Descendent]',
            'AMType' => '[data][type]',
            'AMTypeOptions' => '[tv=>TV][movie=>Movie][ova=>OVA][special=>Special][ona=>ONA][music=>Music]',
            'AMGenre' => '[data][genres]',
            'AMGenreName' => '[data][genres][name]',
            'AMReleaseDate' => '[data][aired][from]',
            'AMImage' => '[data][images][jpg][large_image_url]',
            'AMRating' => '[data][rating]',
            'AMRatingOptions' => '[g=>G - All Ages=>All Ages][pg=>PG - Children=>Children][pg13=>PG-13 - Teens 13 or older=>Teens 13+][r17=>R - 17+ (violence & profanity)=>Violence & Profanity][r=>R+ - Mild Nudity=>Mild Nudity][rx=>Rx - Hentai=>Hentai]',
            'AMDescription' => '[data][synopsis]',
            'AMAuthor' => null,
            'AMAuthorName' => null,
            'AMCEQuantity' => '[data][episodes]',
            'CELink' => 'https://api.jikan.moe/v4/anime/{am_id}/episodes',
            'CEId' => '[data][mal_id]',
            'CENumber' => '[data][mal_id]',
            'CEReleaseDate' => '[data][aired]',
            'CETitle' => '[data][title]',
            'CESeason' => null,
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230202_185443_add_data cannot be reverted.\n";

        return false;
    }
}
