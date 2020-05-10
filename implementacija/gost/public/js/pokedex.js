function search() {
    var input = document.getElementById('searchPokedex');
    var cards = document.getElementsByClassName("pokemon-card");
    var filter = input.value.toLowerCase();

    for (var i=0; i < cards.length; i++) {
        var span = cards[i].getElementsByClassName("pokeName")[0];
        var txtValue = span.textContent || span.innerText;
        if (txtValue.toLowerCase().indexOf(filter) > -1) {
            cards[i].parentNode.style.display = "";
        }
        else {
            cards[i].parentNode.style.display = "none";
        }
    }
}


var mybutton, display;

$(document).ready(() => {
    mybutton = document.getElementById("myBtn")
    display = document.getElementById("pokedexDisplay")
    display.onscroll = () => scrollFunction()
    $('input[type=search]').on('search', function () {
      search();
    });
});

function scrollFunction() {
  if (display.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

function topFunction() {
    $("#pokedexDisplay").animate({ scrollTop: 0 }, "fast");
}