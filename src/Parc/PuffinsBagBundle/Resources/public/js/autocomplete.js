$(function() {
	var availableTags = [
		"Archipel du Frioul",
		"Ratonneau",
		"Tiboulen de Ratonneau",
		"Tiboulen de Ratonneau",
		"Le Grand Salaman",
		"Le Petit Salaman",
		"Ilot des Eyglaudes",
		"Pomegues",
		"Le Gros Esteou",
		"Rocher du Cap Caveaux",
		"Chateau d'If",
		"Ilot du Planier",
		"Archipel de Riou",
		"Les Pharillons nord",
		"Les Pharillons sud",
		"Jarron",
		"Jarre",
		"Ile Plane",
		"Riou",
		"Petit Congloue",
		"Grand Congloue",
		"Ile de Moyade",
		"Les moyadons",
		"Les Empereurs nord",
		"Les Empereurs sud",
		"Ile de la Redonne",
		"Ile Longue",
		"Ile de la Ratonnière",
		"Les Fourmigues Est",
		"Les Fourmigues Ouest",
		"Ile du Portugais",
		"Ile du Petit Langoustier",
		"Gros Sarranier",
		"Petit Sarranier",
		"Porquerolles",
		"Port-cros",
		"Bagaud",
		"Levant",
		"Lavezzi",
		"Archipel des Lavezzi",
		"Isolotto Luigi Giafferi",
		"Isolotto Giacento Paoli",
		"Scoglio della Silene",
		"Sc. Gian Pietro Gaffori",
		"Ito. Pasquale Paoli",
		"Ito. Andrea Ceccaldi",
		"Sc. Di Cala Di u Ghiuncu",
		"Ilot de la Semillante",
		"Ilot L",
		"Cavallo",
		"Camaro Canto",
		"San Bainsu",
		"Sperduto grande",
		"Sperduto piccolo",
		"Ratino",
		"Rocher sud de Ratino",
		"Rocher ouest de Ratino",
		"Rocher est de Ratino",
		"Piana",
		"Porraggia grande",
		"Porraggia piccola",
		"Gavetti",
		"Archipel des Cerbicales",
		"Ilot Toro Grande",
		"Ilot Toro Piccolo",
		"Rocher 1 du Toro Piccolo",
		"Rocher 2 du Toro Piccolo",
		"Ilot du Torello",
		"Pietricaggiosa",
		"Piana",
		"Maestro Maria",
		"Ilot nord Maestro Maria",
		"Rocher de la Vacca",
		"Forana",
		"Archipel des Sanguinaires",
		"Grande Sanguinaire",
		"Isolotto di Cala d'Alga",
		"Isolotto della Locca",
		"Scoglio dei Cormorani",
		"Isolotto di Porro",
		"Pomegues",
	];
	$( "#form_lieudit" ).autocomplete({
	  source: availableTags
	});
	
	$( "#parc_puffinsbagbundle_donneesprincipalestype_lieudit" ).autocomplete({
	  source: availableTags
	});
});