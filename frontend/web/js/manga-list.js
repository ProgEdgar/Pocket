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
