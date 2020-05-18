/**
 * Funkcija kojom se radi pretraživanje pokemona tokom kucanja/brisanja
 *
 * @author Natalija Mitić 0085/2017
 */
function search() {
  var input = document.getElementById('searchPokedex');
  var cards = document.getElementsByClassName("pokemon-card");
  var filter = input.value.toLowerCase();

  for (var i = 0; i < cards.length; i++) {
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

/**
 * Funkcija kojom se aktivira animacija učitavanja, dohvataju informacije za pokedeks
 * i deaktivira animacija učitavanja
 *
 * @author Natalija Mitić 0084/2017
 */
$(document).ready(() => {
  mybutton = document.getElementById("myBtn")
  display = document.getElementById("pokedexDisplay")
  display.onscroll = () => scrollFunction()
  $('input[type=search]').on('search', function () {
    search();
  });
  
  $.ajax({
    url: "https://pokeapi.co/api/v2/pokemon/?limit=251",
    type: "GET",
    beforeSend: function () {
      $(".response").css("display", "none")
      $(".loading").fadeIn('');
    },
    success: function (response) {
      result = response['results'];
      pokeCnt = result.length;
      pokeId = 0;

      first = true;
      prev = null;

      for (i = 0; i < pokeCnt; i++) {
        pokeId++;
        pokeName = result[i]['name'].charAt(0).toUpperCase() + result[i]['name'].slice(1);
        img = 'https://pokeres.bastionbot.org/images/pokemon/' + pokeId + '.png';

        div = $(`<div class='col-lg-4 col-sm-6'>
        <div class='pokemon-card'>
            <a href=${$(location).attr("href")}/${pokeId}>
                <div class='pokeName'><span>#${pokeId}</span> ${pokeName}</div>
                <img class='image' src='${img}'>
            </a>
        </div>
        </div")`);

        if (first) {
          $("#myBtn").after(div);
          first = false;
        }
        else {
          prev.after(div);
        }
        prev = div;
      }


      setTimeout(() => {
        $(".loading").fadeOut('');

        setTimeout(() => $(".response").css("display", "block"), 500)

      }, 500);
    }
  })
});

/**
 * Funkcija kojom se prikazuje dugme za odlazak na vrh
 *
 * @author Natalija Mitić 0084/2017
 */
function scrollFunction() {
  if (display.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

/**
 * Funkcija kojom se obezbeđuje rad dugmeta za odlazak na vrh
 *
 * @author Natalija Mitić 0084/2017
 */
function topFunction() {
  $("#pokedexDisplay").animate({ scrollTop: 0 }, "fast");
}