<?php

use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = 'Pocket Other Manga';
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<div class="bg-color-2 rad-all-15">
    <div class="container-fluid pb-4 px-4">
        <div class="row">
            <div class="col">
                <!-- Page Heading -->
                <div class="mb-4 row">
                    <div class="col">
                        <h4 class="mt-4">Other Manga</h4>
                    </div>
                </div>
                <!-- Approach -->
                <div class="bg-color-1 rad-all-15 p-4">
                    <div class="row">
                        <div class="col-3">
                            <button class="bg-color-3 border-0 rad-t-15 w-100 px-4 py-2" id="button-filter" onclick="PressFilterButton();">
                                <p class="text-color-2 m-0">Filter</p>
                            </button>
                        </div>
                        <div class="col-12">
                            <div class="bg-color-3 rad-b-15 rad-tr-15" id="filters">
                                <div class="row p-3 mx-0" id="filters_genres">
                                    <div class="col-3 pb-2 div-genre-button div-genre-clone">
                                        <button class="bg-color-2 border-0 w-100 mt-2 rad-all-15 py-1 mx-n2 text-c" 
                                            onclick="PressGenreButton($(this).closest('.div-genre-button'),<?=(Yii::$app->user->isGuest)?0:Yii::$app->user->identity->IdUser?>);">
                                            <span class="text-color-1" id="genre-name"></span>
                                            <input type="checkbox" class="radio add-genres" id="genre-add-radio"> <!-- don't forget to add value and name -->
                                            <input type="checkbox" class="radio remove-genres" id="genre-remove-radio"> <!-- don't forget to add value and name -->
                                        </button>
                                    </div>
                                </div>
                                <div class="row px-3 mx-0 pt-3 pb-4">
                                    <div class="col-12">
                                        <div class="row">
                                            <?php if($SortOptions) { ?>
                                                <div class="col-4">
                                                    <select class="sel-color-1 rad-all-15 w-100 p-2 ml-n2" id="filter_order" 
                                                        onchange="(ChangeButtonSearch(<?=(Yii::$app->user->isGuest)?0:Yii::$app->user->identity->IdUser?>))">
                                                        <?php $selected=true; foreach($SortOptions as $Sort){?>
                                                            <option value="<?=$Sort[0]?>" <?=($selected)?'selected="selected"':''?>><?=$Sort[1]?></option>
                                                        <?php $selected=false;} ?>
                                                    </select>
                                                </div>
                                            <?php } if($StatusOptions) { ?>
                                                <div class="col-4">
                                                    <select class="sel-color-1 rad-all-15 w-100 p-2" id="filter_status"
                                                        onchange="(ChangeButtonSearch(<?=(Yii::$app->user->isGuest)?0:Yii::$app->user->identity->IdUser?>))">
                                                        <option value="all" selected="selected">Show All</option>
                                                        <?php foreach($StatusOptions as $Status){?>
                                                            <option value="<?=$Status[0]?>"><?=$Status[2]?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            <?php } ?>
                                            <div class="col-4">
                                                <button class="text-color-2 bg-color-1 border-0 rad-all-15 w-100 py-2 ml-2" id="button-search"
                                                    onclick="(ReloadMangas(<?=(Yii::$app->user->isGuest)?0:Yii::$app->user->identity->IdUser?>))">Search</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row manga-list mt-4">
                        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2 div-manga-clone">
                            <div class="d-flex justify-content-center">
                                <a class="text-c tag-a" id="link" href="">
                                    <img class="tag-img" id="image" src="<?= Yii::$app->urlManagerBackend->baseUrl.'/img/default/manga_alternative.jpg'?>" height="200" width="150">
                                    <p class="text-color-2 tag-p br-word w-150p" id="title"> Title </p>
                                </a>
                            </div>
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
    var Api = <?=$JavaApi?>;
    var GenreClone = $('.div-genre-clone').clone();
    var MangaClone = $('.div-manga-clone').clone();
    document.getElementById("filters").style.display = "none";
    var btnClass = document.getElementById('button-filter');
    var btnClassName = btnClass.className;
    btnClass.className = btnClassName.replace("rad-t-15", "rad-all-15");
    
    AddAllGenres();
    ChangeButtonSearch();
    //ReloadMangas(0);
    
    function AddAllGenres(){
        var link = Api['GenresAll'];
        $('#filters_genres').html('');

        $.ajax({
            method:"GET",
            url:link
        })
        .done(function(response){
            if(response){
                
            }
            /*if(response.mangas){
                for (i=0; i<response.mangas.length; i++) {
                    var manga_clone = clone.clone();
                    if(response.mangas[i].SrcImage != null){	
                        $('#image', manga_clone).attr('src',urlBackend+'/img'+response.mangas[i].SrcImage);
                    }
                    $('#title', manga_clone).text(response.mangas[i].Title);
                    $("#link", manga_clone).attr("href", '<?=Yii::$app->request->baseUrl.'/'.'manga/'?>'+response.mangas[i].IdManga);
                    $('.manga-list').append(manga_clone);
                }
            }else{
                document.getElementById("no-manga").style.display = "block";
            }*/
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
                for(var i=0;i<total.length;i++){
                    if(i==0){
                        ResponseTotal= response[total[i]];
                    }else{
                        ResponseTotal= ResponseTotal[total[i]];
                    }
                }
                if(ResponseTotal){
                    $('#button-search').text('Search ('+ResponseTotal+')');
                }else{
                    $('#button-search').text('Search (0)');
                }
            }else{
                $('#button-search').text('Search (?????)');
            }
        });
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
    
    /*function PressGenreButton(GenreDiv, user_id){
        var GenreButton = GenreDiv.find('button').first();
        var GenreAddInput = GenreDiv.find('.add-genres').first();
        var GenreRemoveInput = GenreDiv.find('.remove-genres').first();

        var btnClassName = GenreButton.className;
        if(GenreAddInput.is(':checked') == false && GenreRemoveInput.is(':checked') == false){
            var classButton = GenreButton.attr("class").replace( "bg-color-2", "bg-color-4").replace( "bg-color-6", "bg-color-4");
            GenreAddInput.prop('checked', true);
            GenreRemoveInput.prop('checked', false);
            GenreButton.attr('class', classButton);
        }else{
            if(GenreAddInput.is(':checked') == true && GenreRemoveInput.is(':checked') == false){
                var classButton = GenreButton.attr("class").replace( "bg-color-2", "bg-color-6").replace( "bg-color-4", "bg-color-6");
                GenreAddInput.prop('checked', false);
                GenreRemoveInput.prop('checked', true);
                GenreButton.attr('class', classButton);
            }else{
                var classButton = GenreButton.attr("class").replace( "bg-color-6", "bg-color-2").replace( "bg-color-4", "bg-color-2");
                GenreAddInput.prop('checked', false);
                GenreRemoveInput.prop('checked', false);
                GenreButton.attr('class', classButton);
            }
        }
        ChangeButtonSearch(user_id);
    }/**/
    

    /*function ReloadMangas(user_id){
        $('.manga-list').html('');

        var link = urlBackend+"api/manga/allmanga/" + GetFilters(user_id);
        $.ajax({
            method:"GET",
            url:link
        })
        .done(function(response){
            if(response.mangas){
                document.getElementById("no-manga").style.display = "none";
                for (i=0; i<response.mangas.length; i++) {
                    var manga_clone = clone.clone();
                    if(response.mangas[i].SrcImage != null){	
                        $('#image', manga_clone).attr('src',urlBackend+'/img'+response.mangas[i].SrcImage);
                    }
                    $('#title', manga_clone).text(response.mangas[i].Title);
                    $("#link", manga_clone).attr("href", '<?=Yii::$app->request->baseUrl.'/'.'manga/'?>'+response.mangas[i].IdManga);
                    $('.manga-list').append(manga_clone);
                }
            }else{
                document.getElementById("no-manga").style.display = "block";
            }
        })
    }/**/
    
    function GetFilters(){
        // Obtain order and status
        var SelectOption = document.getElementById("filter_order");
        var SelectStatus = document.getElementById("filter_status");
        var Option = SelectOption.options[SelectOption.selectedIndex].value.split('==');
        var Status = SelectStatus.options[SelectStatus.selectedIndex].value;
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
        var Filters = '?'+(Genres?Genres+'&':'')+OrderBy+(SortBy?'&'+SortBy:'');

        return Filters;
    }/**/

    function StringToArray(String){
        String = String.replace(/]/g,'');
        var Array = String.split('[');
        Array.shift();
        return Array;
    }
</script>