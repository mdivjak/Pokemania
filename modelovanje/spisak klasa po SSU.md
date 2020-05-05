# Spisak svih stranica
- index
- login
- register
- admin
- korisnik
- borba-divlji
- borba-turnir
- pogadjanje
- pokedex
- pokedex-pokemon
- pregled-prijava
- pregled-svih-turnira
- pregled-korisnika-turnira

# 1. SSU - Borba sa divljim pokemonima i njihovo hvatanje

borba-divlji.php (klikom sa korisnik.html)\
borba-divlji.html

### 1. korisnik pobedjuje

korisnik.php (dodaje mu se pokekes i XP pokemonu)\
	update User, owns\
korisnik.html

### 2. korisnik gubi

korisnik.php (gubi pokekes, koliko?)\
	update User\
korisnik.html

### 3. korisnik hvata pokemona

korisnik.php\
	update User (gubi pokeloptu)\
	insert owns (kog je nivoa i xpa uhvaceni pokemon)?\
korisnik.html

### 4. korisnik ne uspeva da uhvati pokemona

korisnik.php\
	update User\
korisnik.html

# 2. SSU - Autorizacija korisnika

index.html

### 1. korisnik zahteva logovanje

index.html (prikazuje se forma)

### 2. uspesno logovanje

login.php\
	select User\
admin.php (u zavisnosti od role)\
admin.html\
korisnik.php\
korisnik.html

### 3. pogresni podaci

login.php\
	select User\
index.html (prikazuje se greska)

### 4. uspesno resetuje lozinku

login.php\
	select User\
index.html (ostaje na istoj, salje mu se mejl)

### 5. korisnik unosi pogresan e-mail pri resetovanju

login.php\
	select User\
index.html (prikazuje se poruka)

# 3. SSU - Borba na turniru

borba-turnir.php (klikom sa korisnik.html)\
	select Tournament, User, registered, owns (da se provere da li moze da se bori)\
borba-turnir.html

### 1. korisnik pobedjuje na turniru

korisnik.php (dodaju se poeni za turnir i pokekes, pokemoni dobijaju XP)\
	update participates, User, owns
korisnik.html

### 2. korisnik gubi na turniru

korisnik.php (gubi odredjene poene na turniru)\
	update participates
korisnik.html

### 3. korisnik ne moze da se bori jer je isteklo vreme trajanja turnira

korisnik.php (prikazuje se poruka o isteku turnira)\
	select Tournament, User\
korisnik.html

### 4. ne ispunjava uslove

korisnik.php (ispisuje se poruka da ne ispunjava uslove)\
	select Tournament, User, registered\
korisnik.html

### 5. bira opciju za izlazak sa turnira

korisnik.php (prikazuje se poruka da je izasao sa turnira)\
	delete registered\
korisnik.html


# 4. SSU - Brisanje turnira

admin.php (dolazi sa index.html kad se uloguje)\
amdin.html

### 1. admin pritiska dugme za brisanje

admin.php (najboljem igracu se dodeljuje nagrada ako ima bar jednu pobedu, svi igraci dobijaju poruku da je turnir zavrsen i obavestenje o njihovom rangu)\
	delete Tournament, registered, participates\
admin.html

# 5. SSU - Hranjenje pokemona

korisnik.php (dolazi sa index.html kad se uloguje)\
korisnik.html

### 1. korisnik pritiska dugme za hranjenje

korisnik.php (pokemonu se dodaje XP, korisnik gubi vockicu)\
	update User, owns\
korisnik.html

### 2. pokemon prelazi na sledeci nivo

korisnik.php (povecava se HP, nivo, broj XP za sledeci nivo)\
	update owns
korinik.html

### 3. korisnik nema tri pokemona za borbu na turniru na koji je prijavljen

korisnik.php (ostaje rangiran na turniru, niko ne moze da se bori protiv njegovih pokemona)\
korisnik.html

# 6. SSU - Igra prepoznavanja pokemona

pogadjanje.php (dolazi sa index.html)\
pogadjanje.html

### 1. korisnik / gost zapocinje igru

pogadjanje.php (prikazuje se silueta pokemona)\
pogadjanje.html

### 2. gost pogadja

pogadjanje.php (prikazuje se slika pogodjenog pokemona, zatim silueta novog, prikazuje se poruka da je pogodio)\
pogadjanje.html

### 3. korisnik pogadja

pogadjanje.php (sve kao za gosta samo sto dobija i pokekes)\
	update User
pogadjanje.html

### 4. korisnik / gost ne pogadja pokemona

pogadjanje.php (dobija poruku da nije pogodio i moze ponovo da pokusa)\
pogadjanje.html

# 7. SSU - Koriscenje pokedeksa

pokedex.php (dolazi sa index.html)\
pokedex.html

### 1. korisnik / gost zapocinje koriscenje pokedexa

pokedex.php\
pokedex.html

### 2. bira zeljenog pokemona

pokedex-pokemon.php (klikom na pokemona)\
pokedex-pokemon.html

### 3. bira pokemona pretragom

pokedex.php (izvrsava upit ka bazi)\
pokedex.html

### 4. zahteva narednog pokemona

pokedex-pokemon.php (bio je na ovoj i ostaje na njoj, vrsi se novi upit ka bazi i prikaz podataka)\
pokedex-pokemon.html

### 5. zahteva prethodnog pokemona

pokedex-pokemon.php (bio je na ovoj i ostaje na njoj, vrsi se novi upit ka bazi i prikaz podataka)\
pokedex-pokemon.html


# 8. SSU - Kreiranje turnira

admin.php (nakon logovanje sa index.html)\
admin.html

### 1. admin unosi podatke za kreiranje turnira

turnirForm\
admin.php (unosi sve podatke na formi)\
	insert Tournament\
admin.html

# 9. SSU - Kupovina u prodavnici

korisnik.php (dolazi sa index.html)\
korisnik.html

### 1. uspesna kupovina pokelopte

korisnik.php (korisniku se skida 50 pokekesa)\
	select User\
	update User\
korisnik.html

### 2. uspesna kupovina vockice

korisnik.php (korisniku se skida 10 pokekes)\
	select User\
	update User\
korisnik.html

### 3. nema dovoljno pokekesa

korisnik.php (prikazuje se poruka da nema dovoljno pokekesa)\
korisnik.html

# 10. SSU - Pregled profila

korisnik.php (sa index.html)\
korisnik.html

### 1. nema dovoljno vockica

korisnik.php (dugme za hranjenje je onemoguceno pri ucitavanju)\
	select User\
korisnik.html

### 2. korisnik hrani pokemona

korisnik.php (dugme je omoguceno pri ucitavanju, klikom hrani pokemona)\
	select User\
	update User\
korisnik.html

### 3. pusta pokemona u divljinu

korisnik.php (pritiskom na dugme pocinje SSU - Pustanje pokemona u divljinu)\
	update User\
	delete owns\
korisnik.html

# 11. SSU - Pregledanje prijava za turnir

admin.php (sa index.html)\
admin.html

### 1. admin klikne na pregled prijava

pregled-prijava.php (otvara se spisak prijava za taj turnir)\
	select registered\
pregled-prijava.html

### 2. admin klikne na dugme za prihvatanje prijave

pregled-prijava.php (belezi se da je prijavljen na turnir, ucesnik dobija obavestenje da mu je prihvacena prijava)\
	delete registered\
	update participates\
pregled-prijava.html

### 3. admin odbija prijavu

pregled-prijava.php (odbija se prijava, treneru se vraca novac, trener dobija obavestenje da nije prihvacen na turnir)\
	delete registered\
pregled-prijava.html

# 12. SSU - Pustanje pokemona u divljinu

korisnik.php (sa index.html)\
korisnik.html

### 1. pritiska dugme za pustanje u divljinu

korisnik.php (pokemon se brise sa profila, trener dobija nazad jednu pokeloptu)\
	update User\
	delete owns\
korisnik.html

### 2. nema vise dovoljno pokemona za ucesce na nekom turniru

korisnik.php (vise ne moze da igra na tom turniru, ostaje rangiran, niko vise ne moze da se bori protiv njegovih pokemona)\
korisnik.html

# 13. SSU - Registracija korisnika

index.html

### 1. korisnik zahteva registraciju

index.html (prikazuje se forma za registraciju)

### 2. korisnik se uspesno registruje

korisnik.php (dobija poruku da je registracija uspesna, dodeljuje mu se jedan od cetiri pokemona, dodeljuju mu se 3 pokelopte i 500 pokekesa)\
	insert User, owns\
korisnik.html

### 3. korisnik unosi nepostojeci e-mail

index.html (dobija odgovarajucu poruku)\
	select User

### 4. unosi vec registrovani e-mail

index.html (dobija odgovarajucu poruku)\
	select User

# 14. SSU - Ucestvovanje na turniru

pregled-svih-turnira.php (dolazi sa korisnik.html)\
	select Tournament\
pregled-svih-turnira.html

### 1. korisnik se uspesno prijavljuje

pregled-korisnika-turnira.php (prikazuje se spisak svih korisnika turnira)\
	select participates\
pregled-korisnika-turnira.html

### 2. ne ispunjava zahteve turnira

pregled-svih-turnira.php (prikazuje se poruka)\
	select Tournament, User, owns\
pregled-svih-turnira.html

### 3. nema dovoljno pokekesa za prijavu

pregled-svih-turnira.php (prikazuje se poruka)\
	select User\
pregled-svih-turnira.html

### 4. korisnik ima manje od tri pokemona

pregled-svih-turnira.php (prikazuje se poruka da nema dovoljno pokemona)\
	select User, owns\
pregled-svih-turnira.html
