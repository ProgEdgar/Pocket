function AddAllGenres(){
    $('#filters_genres').html('');
    var link = Api['GenresLink'];

    $.ajax({
        method:"GET",
        url:link
    })
    .done(function(response){
        var ResponseData = response['data'];
        if(ResponseData){
            for(var i=0; i<ResponseData.length; i++){
                var ResponseId = ResponseData[i]['mal_id'];
                var ResponseName = ResponseData[i]['name'];
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
    var link = Api['AMSearchLink']+GetFilters()

    $.ajax({
        method:"GET",
        url:link
    })
    .done(function(response){
        if(response){
            var ResponseTotal= response['pagination']['items']['total'];
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

    link = link+'&page='+PageNumber;

    if(PageNumber <= document.getElementById('button-search').value){
        $.ajax({
            method:"GET",
            url:link
        })
        .done(function(response){
            var ResponseData = response['data'];
            if(ResponseData){
                document.getElementById("no-manga").style.display = "none";
                for(var i=0; i<ResponseData.length; i++){
                    var Authors = null;
                    var Genres = null;
                    var ResponseAuthor = ResponseData[i]['authors'];
                    var ResponseGenres = ResponseData[i]['genres'];

                    if(ResponseAuthor){
                        for(var i2=0; i2<ResponseAuthor.length;i2++){
                            if(i2==0){
                                Authors = ResponseAuthor[i2]['name'].replace(',','');
                            }else{
                                Authors = Authors+', '+ResponseAuthor[i2]['name'].replace(',','');
                            }
                        }
                    }

                    if(ResponseGenres){
                        for(var i2=0; i2<ResponseGenres.length;i2++){
                            if(i2==0){
                                Genres = ResponseGenres[i2]['name'];
                            }else{
                                Genres = Genres+', '+ResponseGenres[i2]['name'];
                            }
                        }
                    }

                    var manga_clone = MangaClone.clone();
                    $('#manga-link', manga_clone).attr('href',baseUrl+'/api/'+Api['IdApi']+'/manga/'+ResponseData[i]['mal_id']);
                    $('#manga-image', manga_clone).attr('src',ResponseData[i]['images']['jpg']['large_image_url']);
                    $('#manga-title', manga_clone).text((ResponseData[i]['title']?ResponseData[i]['title']:''));
                    $('#manga-alt-title', manga_clone).text((ResponseData[i]['title_english']?ResponseData[i]['title_english']:''));
                    $('#manga-author', manga_clone).text((Authors?Authors:''));
                    $('#manga-chapters', manga_clone).text((ResponseData[i]['chapters']?ResponseData[i]['chapters']+' in total':''));
                    $('#manga-genres', manga_clone).text((Genres?Genres:''));
                    $('#manga-type', manga_clone).text((ResponseData[i]['type']?ResponseData[i]['type']:''));
                    $('#manga-description', manga_clone).text((ResponseData[i]['synopsis']?ResponseData[i]['synopsis']:''));
                    $('.manga-list').append(manga_clone);
                    ScrollMax = document.documentElement.scrollHeight-500;
                }
            }else{
                document.getElementById("no-manga").style.display = "block";
            }
        });
    }
}/**/

function InfoManga(){
    $('.div-genre-clone').remove();
    var link = Api['AMLink'].replace('{am_id}', IdManga);

    $.ajax({
        method:"GET",
        url:link
    })
    .done(function(response){
        var ResponseData = response['data'];
        if(ResponseData){
            var Authors = null;
            var Genres = null;
            var ResponseAuthor = ResponseData['authors'];
            var ResponseGenres = ResponseData['genres'];
            var ResponseDate = (ResponseData['published']['from']?ResponseData['published']['prop']['from']['day']+'/'+ResponseData['published']['prop']['from']['month']+'/'+ResponseData['published']['prop']['from']['year']:null);
  
            if(ResponseAuthor){
                for(var i=0;i<ResponseAuthor.length;i++){
                    if(i==0){
                        Authors = ResponseAuthor[i]['name'].replace(',','');
                    }else{
                        Authors = Authors+', '+ResponseAuthor[i]['name'].replace(',','');
                    }
                }
            }

            if(ResponseGenres){
                for(var i=0;i<ResponseGenres.length;i++){
                    var genre_clone = GenreClone.clone();
                    $('#genre-name', genre_clone).text(ResponseGenres[i]['name']);
                    $('#manga-genres-list').append(genre_clone);
                }
            }

            $('#manga-image').attr('src',ResponseData['images']['jpg']['large_image_url']);
            $('#manga-title').text((ResponseData['title']?ResponseData['title']:''));
            $('#manga-orig-title').text((ResponseData['title_japanese']?ResponseData['title_japanese']:''));
            $('#manga-alt-title').text((ResponseData['title_english']?ResponseData['title_english']:''));
            $('#manga-author').text((Authors?Authors:''));
            $('#manga-release-date').text((ResponseDate?ResponseDate:'??/??/????'));
            $('#manga-status').text((ResponseData['status']?ResponseData['status']:''));
            $('#manga-chapters').text((ResponseData['chapters']?ResponseData['chapters']+' in total':''));
            $('#manga-type').text((ResponseData['type']?ResponseData['type']:''));
            $('#manga-description').text((ResponseData['synopsis']?ResponseData['synopsis']:''));
        }else{
            //document.getElementById("no-manga").style.display = "block";                                              To Replace
        }
    });
}/**/

function GetFilters(){
    // Obtain order and status
    var SelectOption = document.getElementById("filter_order");
    var SelectType = document.getElementById("filter_type");
    var SelectStatus = document.getElementById("filter_status");
    var Option = SelectOption.options[SelectOption.selectedIndex].value.split('==');
    var TypeValue = SelectType.options[SelectType.selectedIndex].value;
    var StatusValue = SelectStatus.options[SelectStatus.selectedIndex].value;
    var OrderBy = Option[0];
    var SortBy = Option[1];
    var Type = null;
    var Status = null;

    // Check Type and Status Value
    if(TypeValue){
        Type = Api['SearchType']+'='+TypeValue;
    }
    if(StatusValue){
        Status = Api['SearchStatus']+'='+StatusValue;
    }

    // Obtain all genres that want and don't want
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
                    LinkAddGenre = LinkAddGenre+','+AddGenres[i].value;
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
                    LinkRemoveGenre = LinkRemoveGenre+','+RemoveGenres[i].value;
                }
            }
        }
    }

    // Put genres and no genres together
    var Genres = null;
    if(LinkAddGenre){
        Genres = 'genres='+LinkAddGenre;
    }
    if(LinkRemoveGenre){
        if(Genres){
            Genres = Genres+'&genres_exclude='+LinkRemoveGenre;
        }else{
            Genres = 'genres_exclude='+LinkRemoveGenre;
        }            
    }

    // Generate end link
    var Filters = '?'+(Genres?Genres+'&':'')+(Type?Type+'&':'')+(Status?Status+'&':'')+'order_by='+OrderBy+'&sort='+SortBy;
    
    return Filters;
}/**/

function addApiFavorite(manga_id){
    var link = this_web_api+"api/api-favorite/create";
    $.post(link,
    {
        IdUser: user_id,
        IdManga: manga_id,
    },
    function(response){
        if(response != null){
            var img = $("#img-fav");
            var tag_a = $("#img-tag-a");
            var src = img.attr('src');
            var onclick = tag_a.attr('onClick');
            if(response == "Added to Favorites" || response == "Already in Favorites"){
                img.attr('src', src.replace("unfavorite", "favorite"));
                tag_a.attr('onClick', onclick.replace("add", "remove"));
            }
        }
    });
}

function removeApiFavorite(manga_id){
    var link = this_web_api+"api/api-favorite/delete/user/"+user_id+"/manga/"+manga_id;
    $.ajax({
        method:"DELETE",
        url:link
    })
    .done(function(response){
        if(response != null){
            var img = $("#img-fav");
            var tag_a = $("#img-tag-a");
            var src = img.attr('src');
            var onclick = tag_a.attr('onClick');
            if(response == "Removed from Favorites" || response == "It Wasn´t on Favorites"){
                img.attr('src', src.replace("favorite", "unfavorite"));
                tag_a.attr('onClick', onclick.replace("remove", "add"));
            }
        }
    })
}
function addApiLibrary(manga_id){
    var link = this_web_api+"api/api-library/create";
    $.post(link,
    {
        IdUser: user_id,
        IdManga: manga_id,
    },
    function(response){
        if(response != null){
            var span = $("#library-span");
            var tag_a = $("#library-tag-a");
            var text = span.text();
            var onclick = tag_a.attr('onClick');
            var className = tag_a.attr('class');
            if(response == "Added to Library" || response == "Already in Library"){
                tag_a.attr('onClick', onclick.replace("add", "remove"));
                tag_a.attr('class', className.replace("bg-color-4", "bg-color-6").replace("success", "error"));
                span.text(text.replace("Add to", "Remove from"));
            }
        }
    });
}

function removeApiLibrary(manga_id){
    var link = this_web_api+"api/api-library/delete/user/"+user_id+"/manga/"+manga_id;
    $.ajax({
        method:"DELETE",
        url:link
    })
    .done(function(response){
        if(response != null){
            var span = $("#library-span");
            var tag_a = $("#library-tag-a");
            var text = span.text();
            var onclick = tag_a.attr('onClick');
            var className = tag_a.attr('class');
            if(response == "Removed from Library" || response == "It Wasn´t on Library"){
                tag_a.attr('onClick', onclick.replace("remove", "add"));
                tag_a.attr('class', className.replace("bg-color-6", "bg-color-4").replace("error", "success"));
                span.text(text.replace("Remove from", "Add to"));
            }
        }
    })
}