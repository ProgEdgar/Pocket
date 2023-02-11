<?php

use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = 'PocketManga';
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<div class="bg-color-2 rad-all-15 ">
    <div class="container-fluid pb-4 px-4 b-35">
        <div class="row">
            <div class="col">
                <!-- Page Heading -->
                <div class="mb-4 row">
                    <div class="col">
                        <h4 class="mt-4" id="test-title">Other Manga</h4>
                    </div>
                </div>
                <!-- Approach -->
                <div class="bg-color-1 rad-all-15 p-4">
                    <div class="row">
                        <div class="col-3">
                            <button class="bg-color-3 border-0 rad-t-15 w-100 px-4 py-2" id="button-filter" onclick="PressFilterButton();">
                                <p class="text-color-2 m-0 ts-18">Filter</p>
                            </button>
                        </div>
                        <div class="col-12">
                            <div class="bg-color-3 rad-b-15 rad-tr-15" id="filters">
                                <div class="row p-3 mx-0" id="filters_genres">
                                    <div class="col-3 pb-2 div-genre-button div-genre-clone">
                                        <button class="bg-color-1 border-0 w-100 mt-2 rad-all-15 py-1 mx-n2 text-c" 
                                            onclick="PressGenreButton($(this).closest('.div-genre-button'));">
                                            <span class="text-color-2" id="genre-name"></span>
                                            <input type="checkbox" class="radio add-genres" id="genre-add-radio"> <!-- don't forget to add value and name -->
                                            <input type="checkbox" class="radio remove-genres" id="genre-remove-radio"> <!-- don't forget to add value and name -->
                                        </button>
                                    </div>
                                </div>
                                <div class="row px-3 mx-0 pt-3 pb-4">
                                    <div class="col-12">
                                        <div class="row">
                                            <?php if($SortOptions) { ?>
                                                <div class="col-3">
                                                    <select class="sel-color-1 rad-all-15 w-100 p-2 ml-n2" id="filter_order" 
                                                        onchange="ChangeButtonSearch()">
                                                        <?php $selected=true; foreach($SortOptions as $Sort){?>
                                                            <option value="<?=$Sort[0]?>" <?=($selected)?'selected="selected"':''?>><?=$Sort[1]?></option>
                                                        <?php $selected=false;} ?>
                                                    </select>
                                                </div>
                                            <?php } if($StatusOptions) { ?>
                                                <div class="col-3">
                                                    <select class="sel-color-1 rad-all-15 w-100 p-2" id="filter_status"
                                                        onchange="ChangeButtonSearch()">
                                                        <option value="all" selected="selected">Show All Status</option>
                                                        <?php foreach($StatusOptions as $Status){?>
                                                            <option value="<?=$Status[0]?>"><?=$Status[2]?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            <?php } if($TypeOptions) { ?>
                                                <div class="col-3">
                                                    <select class="sel-color-1 rad-all-15 w-100 p-2" id="filter_type"
                                                        onchange="ChangeButtonSearch()">
                                                        <option value="all" selected="selected">Show All Types</option>
                                                        <?php foreach($TypeOptions as $Type){?>
                                                            <option value="<?=$Type[0]?>"><?=$Type[1]?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            <?php } ?>
                                            <div class="col-3">
                                                <button class="text-color-2 bg-color-1 border-0 rad-all-15 w-100 py-2 ml-2" id="button-search" value="1" onclick="SearchMangas()">Search</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row manga-list mt-4">
                        <div class="col-12 div-manga-clone">
                            <a class="text-dec-none" id="link" href="">
                                <div class="row p-2 bord-all-5-sol-color-2 mx-2 mb-3 rad-all-15">
                                    <div class="col-auto p-0">
                                        <img class="rad-all-10" id="manga-image" src="<?= Yii::$app->urlManagerBackend->baseUrl.'/img/default/manga_alternative.jpg'?>" height="200" width="150">
                                    </div>
                                    <div class="col row">
                                        <div class="col-12"><span class="text-color-3 text-l ts-18 bold"> Title: <span class="text-color-2 ts-18 no-bold" id="manga-title"></span></span></div>
                                        <div class="col-12"><span class="text-color-3 text-l ts-18 bold"> Alternative Title: <span class="text-color-2 ts-18 no-bold" id="manga-alt-title"></span></span></div>
                                        <div class="col-6"><span class="text-color-3 text-l ts-18 bold"> Author: <span class="text-color-2 ts-18 no-bold" id="manga-author"></span></span></div>
                                        <div class="col-6"><span class="text-color-3 text-l ts-18 bold"> Chapters: <span class="text-color-2 ts-18 no-bold" id="manga-chapters"></span></span></div>
                                        <div class="col-6"><span class="text-color-3 text-l ts-18 bold"> Genres: <span class="text-color-2 ts-18 no-bold" id="manga-genres"></span></span></div>
                                        <div class="col-6"><span class="text-color-3 text-l ts-18 bold"> Type: <span class="text-color-2 ts-18 no-bold" id="manga-type"></span></span></div>
                                        <div class="col-12"><span class="text-color-3 text-l ts-18 bold"> Description: <span class="text-color-2 ts-18 no-bold ellipse" id="manga-description"></span></span></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="row" id="no-manga">
                        <div class="col">
                            <p class="text-color-2" id="p-no-manga"> There are no manga </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var baseUrl = '<?=Yii::$app->request->baseUrl?>';
    var Api = <?=$JavaApi?>;
    var PageNumber = 1;
    var NumPerPage = 25;
    var GenreClone = $('.div-genre-clone').clone();
    var MangaClone = $('.div-manga-clone').clone();
    var ScrollMax = document.documentElement.scrollHeight-500;
    document.getElementById("filters").style.display = "none";
    var btnClass = document.getElementById('button-filter');
    var btnClassName = btnClass.className;
    btnClass.className = btnClassName.replace("rad-t-15", "rad-all-15");
    
    AddAllGenres();
    ChangeButtonSearch();
    AddMangas();
    
    window.onscroll = function() {
        var ScrollPx = $(window).scrollTop() + $(window).height();;
        if (ScrollPx >= ScrollMax) {
            ScrollMax = document.documentElement.scrollHeight+10000;
            PageNumber++;
            AddMangas();
        }
    };
    
    function SearchMangas(){
        AddMangas();
        PressFilterButton();
    }

    function AddAllGenres(){
        $('#filters_genres').html('');
        var link = Api['GenresAll'];
        var Data = StringToArray(Api['Data']);
        var GenreId = StringToArray(Api['GenresId']);
        var GenreName = StringToArray(Api['GenresName']);
        var ResponseData = null;
        var ResponseId = null;
        var ResponseName = null;

        $.ajax({
            method:"GET",
            url:link
        })
        .done(function(response){
            ResponseData = GetResponsePath(response, Data);
            if(ResponseData){
                for(var i=0; i<ResponseData.length; i++){
                    ResponseId = GetResponsePath(ResponseData[i],GenreId);
                    ResponseName = GetResponsePath(ResponseData[i],GenreName);
                    var genre_clone = GenreClone.clone();
                    $('#genre-name', genre_clone).text(ResponseName);
                    $('#genre-add-radio', genre_clone).attr('value',ResponseId);
                    $('#genre-add-radio', genre_clone).attr('name',ResponseName);
                    $('#genre-remove-radio', genre_clone).attr('value',ResponseId);
                    $('#genre-remove-radio', genre_clone).attr('name',ResponseName);
                    $('#filters_genres').append(genre_clone);
                }
            }
        })
    }/**/

    function ChangeButtonSearch(){
        var link = Api['AMSearchLink']+GetFilters();
        var total = StringToArray(Api['SearchTotal']);
        var ResponseTotal = null;

        $.ajax({
            method:"GET",
            url:link
        })
        .done(function(response){
            if(response){
                ResponseTotal= GetResponsePath(response,total);
                if(ResponseTotal){
                    $('#button-search').text('Search ('+ResponseTotal+')');
                    $('#button-search').attr('value', Math.ceil(ResponseTotal/NumPerPage));
                }else{
                    $('#button-search').text('Search (0)');
                    $('#button-search').attr('value', 1);
                }
            }else{
                $('#button-search').text('Search (?????)');
                $('#button-search').attr('value', 1);
            }
        });
    }/**/

    function AddMangas(){
        if(PageNumber == 1){
            $('.manga-list').html('');
        }
        var link = Api['AMSearchLink']+GetFilters();
        var Data = StringToArray(Api['Data']);
        var MangaId = StringToArray(Api['AMId']);
        var MangaTitle = StringToArray(Api['AMTitle']);
        var MangaAltTitle = StringToArray(Api['AMAlternativeTitle']);
        var MangaAuthor = StringToArray(Api['AMAuthor']);
        var MangaAuthorName = StringToArray(Api['AMAuthorName']);
        var MangaChapters = StringToArray(Api['AMCEQuantity']);
        var MangaGenres = StringToArray(Api['AMGenre']);
        var MangaGenresName = StringToArray(Api['AMGenreName']);
        var MangaType = StringToArray(Api['AMType']);
        var MangaDescription = StringToArray(Api['AMDescription']);
        var MangaImage = StringToArray(Api['AMImage']);
        var ResponseData = null;
        var ResponseId = null;
        var ResponseTitle = null;
        var ResponseAltTitle = null;
        var ResponseAuthor = null;
        var ResponseAuthorName = null;
        var ResponseChapters = null;
        var ResponseGenres = null;
        var ResponseGenresName = null;
        var ResponseType = null;
        var ResponseDescription = null;
        var ResponseImage = null;

        if(Api['SearchPage']!==''){
            link = link+'&'+Api['SearchPage']+'='+PageNumber;
        }
        if(PageNumber <= document.getElementById('button-search').value){
            $.ajax({
                method:"GET",
                url:link
            })
            .done(function(response){
                ResponseData = GetResponsePath(response,Data);
                if(ResponseData){
                    document.getElementById("no-manga").style.display = "none";
                    for(var i=0; i<ResponseData.length; i++){
                        var Authors = null;
                        var Genres = null;

                        ResponseId = GetResponsePath(ResponseData[i],MangaId);
                        ResponseTitle = GetResponsePath(ResponseData[i],MangaTitle);
                        ResponseAltTitle = GetResponsePath(ResponseData[i],MangaAltTitle);
                        ResponseAuthor = GetResponsePath(ResponseData[i],MangaAuthor);
                        ResponseChapters = GetResponsePath(ResponseData[i],MangaChapters);
                        ResponseGenres = GetResponsePath(ResponseData[i],MangaGenres);
                        ResponseType = GetResponsePath(ResponseData[i],MangaType);
                        ResponseDescription = GetResponsePath(ResponseData[i],MangaDescription);
                        ResponseImage = GetResponsePath(ResponseData[i],MangaImage);

                        for(var i; i<ResponseAuthor.length;i++){
                            ResponseAuthorName = GetResponsePath(ResponseAuthor[i],MangaAuthorName);
                            if(i==0){
                                Authors = ResponseAuthorName;
                            }else{
                                Authors = Authors+', '+ResponseAuthorName;
                            }
                        }

                        for(var i; i<ResponseAuthor.length;i++){
                            ResponseGenresName = GetResponsePath(ResponseGenres[i],MangaGenresName);
                            if(i==0){
                                Genres = ResponseGenresName;
                            }else{
                                Genres = Genres+', '+ResponseGenresName;
                            }
                        }
                        
                        var manga_clone = MangaClone.clone();
                        $('#manga-link', manga_clone).attr('href',baseUrl+'/api/'+Api['Name']+'/manga-'+ResponseId);
                        $('#manga-image', manga_clone).attr('src',ResponseImage);
                        $('#manga-title', manga_clone).text((ResponseTitle?ResponseTitle:''));
                        $('#manga-alt-title', manga_clone).text((ResponseAltTitle?ResponseAltTitle:''));
                        $('#manga-author', manga_clone).text((Authors?Authors:''));
                        $('#manga-chapters', manga_clone).text((ResponseChapters?ResponseChapters+' in total':''));
                        $('#manga-genres', manga_clone).text((Genres?Genres:''));
                        $('#manga-type', manga_clone).text((ResponseType?ResponseType:''));
                        $('#manga-description', manga_clone).text((ResponseDescription?ResponseDescription:''));
                        $('.manga-list').append(manga_clone);
                        ScrollMax = document.documentElement.scrollHeight-500;
                    }
                }else{
                    document.getElementById("no-manga").style.display = "block";
                }
            });
        }
    }/**/
    
    function PressFilterButton(){
        var div = document.getElementById("filters");
        var btnClass = document.getElementById('button-filter');
        var btnClassName = btnClass.className;
        if(div.style.display == "none"){
            document.getElementById("filters").style.display = "block";
            btnClass.className = btnClassName.replace("rad-all-15", "rad-t-15");
        }else{
            document.getElementById("filters").style.display = "none";
            btnClass.className = btnClassName.replace("rad-t-15", "rad-all-15");
        }
    }/**/
    
    function PressGenreButton(GenreDiv){
        var GenreButton = GenreDiv.find('button').first();
        var GenreAddInput = GenreDiv.find('.add-genres').first();
        var GenreRemoveInput = GenreDiv.find('.remove-genres').first();

        var btnClassName = GenreButton.className;
        if(GenreAddInput.is(':checked') == false && GenreRemoveInput.is(':checked') == false){
            var classButton = GenreButton.attr("class").replace( "bg-color-1", "bg-color-4").replace( "bg-color-6", "bg-color-4");
            GenreAddInput.prop('checked', true);
            GenreRemoveInput.prop('checked', false);
            GenreButton.attr('class', classButton);
        }else{
            if(GenreAddInput.is(':checked') == true && GenreRemoveInput.is(':checked') == false){
                var classButton = GenreButton.attr("class").replace( "bg-color-1", "bg-color-6").replace( "bg-color-4", "bg-color-6");
                GenreAddInput.prop('checked', false);
                GenreRemoveInput.prop('checked', true);
                GenreButton.attr('class', classButton);
            }else{
                var classButton = GenreButton.attr("class").replace( "bg-color-6", "bg-color-1").replace( "bg-color-4", "bg-color-1");
                GenreAddInput.prop('checked', false);
                GenreRemoveInput.prop('checked', false);
                GenreButton.attr('class', classButton);
            }
        }
        ChangeButtonSearch();
    }/**/
    
    function GetFilters(){
        // Obtain order and status
        var SelectOption = document.getElementById("filter_order");
        var SelectType = document.getElementById("filter_type");
        var SelectStatus = document.getElementById("filter_status");
        var Option = SelectOption.options[SelectOption.selectedIndex].value.split('==');
        var Type = Api['SearchType']+'='+SelectType.options[SelectType.selectedIndex].value;
        var Status = Api['SearchStatus']+'='+SelectStatus.options[SelectStatus.selectedIndex].value;
        var OrderBy = Api['SearchOrderBy']+'='+Option[0];
        var SortBy = (Option[1]?Api['SearchSortBy']+'='+Option[1]:null);

        // Obtain all genres that want and don't want
        var AddGenresDivision = Api['SearchWGenres'].split('=>');
        var RemoveGenresDivision = Api['SearchWOutGenres'].split('=>');
        var AddGenres = new Array();
        var RemoveGenres = new Array();
        AddGenres = document.getElementsByClassName("add-genres");
        RemoveGenres = document.getElementsByClassName("remove-genres");        
        
        // Obtain search key and value for api link about add genres
        var LinkAddGenre = null;
        if(AddGenres.length != 0){
            var num = 0;
            for (i = 0; i < AddGenres.length; i++) {
                if(AddGenres[i].checked){
                    if(num == 0){
                        LinkAddGenre = AddGenres[i].value;
                        num++;
                    }else{
                        LinkAddGenre = LinkAddGenre+AddGenresDivision[1]+AddGenres[i].value;
                    }
                }
            }
        }

        // Obtain search key and value for api link about remove genres
        var LinkRemoveGenre = null;
        if(RemoveGenres.length != 0){
            var num = 0;
            for (i = 0; i < RemoveGenres.length; i++) {
                if(RemoveGenres[i].checked){
                    if(num == 0){
                        LinkRemoveGenre = RemoveGenres[i].value;
                        num++;
                    }else{
                        LinkRemoveGenre = LinkRemoveGenre+RemoveGenresDivision[1]+RemoveGenres[i].value;
                    }
                }
            }
        }

        // Put genres and no genres together
        var Genres = null;
        if(LinkAddGenre){
            Genres = AddGenresDivision[0]+'='+LinkAddGenre;
        }
        if(LinkRemoveGenre){
            if(Genres){
                Genres = Genres+'&'+Api.RemoveGenres+'='+LinkRemoveGenre;
            }else{
                Genres = RemoveGenresDivision[0]+'='+LinkRemoveGenre;
            }            
        }


        // Generate end link
        var Filters = '?'+(Genres?Genres+'&':'')+Type+'&'+Status+'&'+OrderBy+(SortBy?'&'+SortBy:'');
        
        return Filters;
    }/**/

    function StringToArray(String){
        String = String.replace(/]/g,'');
        var Array = String.split('[');
        Array.shift();
        return Array;
    }

    function GetResponsePath(Response,Path){
        var ResponsePath = null;
        for(var i=0;i<Path.length;i++){
            if(i==0){
                ResponsePath = Response[Path[i]];
            }else{
                ResponsePath = ResponsePath[Path[i]];
            }
        }
        return ResponsePath;
    }
</script>