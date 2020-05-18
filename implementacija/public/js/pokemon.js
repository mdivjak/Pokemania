/**
 * Funkcija kojom se aktivira animacija učitavanja, dohvataju informacije za odgovarajućeg pokemona
 * i deaktivira animacija učitavanja
 *
 * @author Natalija Mitić 0084/2017
 */
$(document).ready(() => {
    pokeId = $(location).attr("href").substring($(location).attr("href").lastIndexOf('/') + 1);
    $.ajax({
        url: "https://pokeapi.co/api/v2/pokemon/" + pokeId,
        type: "GET",
        //async: true,
        beforeSend: function () {
            $(".response").css("display", "none")
            $(".loading").fadeIn('');
        },
        success: function (response) {
            name = response['name'];
            document.title = "Pokemania - " + name.charAt(0).toUpperCase() + name.slice(1);
            weight = response['weight']
            height = response['height']

            types = []
            totalTypes = response['types'].length
            for (i = 0; i < totalTypes; i++) {
                types.push({
                    'name': response['types'][i]['type']['name']
                })
            }

            $(".pokeName")[0].innerHTML = `<h1><span>#${pokeId}</span>&nbsp;&nbsp;${name}</h1>`
            $(".specsImg")[0].innerHTML = `<img class="pokemon-image" height="300" width="300" src="https://pokeres.bastionbot.org/images/pokemon/${pokeId}.png" alt="Pokemon image">`;
            $("#weight").text(weight);
            $("#height").text(height);

            first = true;
            prev = null;
            for (i = 0; i < types.length; i++) {
                div = $(`<span class="type ${types[i]['name']}"> ${types[i]['name']} </span>`)

                if (first) {
                    $("#typesList").append(div);
                    first = false
                }
                else {
                    prev.after(div)
                }
                prev = div
            }


            first = true;
            prev = null;
            totalMoves = response['moves'].length
            cntMoves = 0;
            for (i = 0; i < totalMoves && cntMoves < 8; i++) {

                $.ajax({
                    url: response['moves'][i]['move']['url'],
                    async: false,
                    type: "GET",
                    success: function (res) {
                        mName = res['name'];
                        accuracy = res['accuracy']
                        power = res['power']
                        pp = res['pp']
                        type = res['type']['name']
                        damage_class = res['damage_class']

                        if (accuracy != null && power != null && pp != null && damage_class != null) {
                            cntMoves++

                            src = location.origin + "/images/";
                            if (damage_class == 'status') {
                                src += "statusMove.svg"
                            }
                            else if (damage_class == 'special') {
                                src += "specialMove.svg"
                            }
                            else {
                                src += "physicalMove.svg"
                            }
                            div = $(`<div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="pokemon-card moves" style="width: 20rem; height: 24rem;">
                                            <div class="caption">
                                                <p class="move-name"> ${mName}&nbsp;&nbsp;
                                                    <img class="icon damage" src=${src}></img>
                                                </p>
                                                <p class=" move-power"> <b>Power :</b> ${power} </p>
                                                <p class=" move-accuracy"><b>Acc:</b> ${accuracy} %
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar" aria-valuenow="${accuracy}" aria-valuemin="0" aria-valuemax="100" style="width:  ${accuracy}%;">
                                                            <span class="sr-only">${accuracy}% Accuracy</span>
                                                        </div>
                                                    </div>
                                                </p>
                                                <p class=" move-pp"> <b>PP:</b>  ${pp}</p>
                                                <p class="move-damage-class"></p>
                                                <p class=" move-type">
                                                    <span class="type  ${type}"> ${type} </span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>`)

                            if (first) {
                                $("#movesList").append(div);
                                first = false
                            }
                            else {
                                prev.after(div)
                            }
                            prev = div
                        }
                    },
                    complete: function (xhr, textStatus) {
                        console.log(xhr.status);
                    }
                })
            }

            if (cntMoves == 0) {
                $(".moves-title")[0].innerHTML = "No moves"
            }

            setTimeout(() => {
                $(".loading").fadeOut('');

                setTimeout(() => $(".response").css("display", "block"), 500)

            }, 500);
        }
    })
})