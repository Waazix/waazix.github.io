<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Gwladys</title>

<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>

<h1></h1>
<h2></h2>

<h3><span id="discovered"></span>/<span id="total-words"></span></h3>

<div id="refresh" onClick="window.location.reload();">&#x21bb;</div>

<script>
let discoveryCount = parseInt(getCookie('counter')) || 0;
const discoveredWords = JSON.parse(getCookie('discoveredWords') || '[]');

const wordArea = document.querySelector('h1');
const definitionArea = document.querySelector('h2');
const totalWordsArea = document.querySelector('#total-words');
const discoveredWordsArea = document.querySelector('#discovered');

const words = [
	{
		"mot": "Beauté",
		"definition": "Qualité de ce qui est agréable à regarder, d'une grande harmonie visuelle."
	},
	{
		"mot": "Adorable",
		"definition": "Qui suscite une grande affection, qui est extrêmement charmant."
	},
	{
		"mot": "Perfection",
		"definition": "Qualité de ce qui est parfait, sans défaut."
	},
	{
		"mot": "Bonheur",
		"definition": "État de grande satisfaction, de plaisir intense et durable."
	},
	{
		"mot": "Éblouissante",
		"definition": "Qui émet une lumière si forte qu'elle éblouit."
	},
	{
		"mot": "Magique",
		"definition": "Qui a un charme inexplicable, qui semble appartenir à un monde merveilleux."
	},
	{
		"mot": "Irrésistible",
		"definition": "Qui est impossible à refuser ou à ignorer."
	},
	{
		"mot": "Unique",
		"definition": "Qui n'a pas d'égal, qui se distingue parmi tous."
	},
	{
		"mot": "Rayonnante",
		"definition": "Qui brille d'une lumière éclatante, qui transmet de la joie et de l'énergie."
	},
	{
		"mot": "Sublime",
		"definition": "Qui provoque une admiration profonde par sa beauté ou sa grandeur."
	},
	{
		"mot": "Tendre",
		"definition": "Qui montre de la douceur, de la sensibilité, de l'affection."
	},
	{
		"mot": "Divine",
		"definition": "Qui est d'une beauté ou d'une qualité exceptionnelle, céleste."
	},
	{
		"mot": "Inoubliable",
		"definition": "Que l'on ne peut pas oublier, qui marque durablement."
	},
	{
		"mot": "Précieuse",
		"definition": "Qui est d'une grande valeur, qu'on chérit profondément."
	},
	{
		"mot": "Chérie",
		"definition": "Termes affectueux pour désigner une personne qu'on aime et qu'on apprécie profondément."
	},
	{
		"mot": "Doux",
		"definition": "Qui est agréable au toucher ou à l'odorat, qui inspire la tendresse."
	},
	{
		"mot": "Enchantée",
		"definition": "Qui ressent un grand plaisir ou émerveillement."
	},
	{
		"mot": "Élégance",
		"definition": "Qualité de ce qui est distingué, raffiné dans son apparence ou son comportement."
	},
	{
		"mot": "Gentillesse",
		"definition": "Caractère de quelqu'un de bienveillant et attentionné."
	},
	{
		"mot": "Séduisante",
		"definition": "Qui attire et charme, envoûtante."
	},
	{
		"mot": "Câline",
		"definition": "Qui aime les gestes tendres et affectueux."
	},
	{
		"mot": "Joyeuse",
		"definition": "Qui manifeste de la joie, de l'enthousiasme."
	},
	{
		"mot": "Gracieuse",
		"definition": "Qui est pleine de grâce, de charme naturel."
	},
	{
		"mot": "Radieuse",
		"definition": "Qui rayonne de bonheur et de lumière."
	},
	{
		"mot": "Exquise",
		"definition": "D'une beauté ou d'une délicatesse rare et parfaite."
	},
	{
		"mot": "Amour",
		"definition": "Sentiment intense d'affection envers quelqu'un."
	},
	{
		"mot": "Sérénité",
		"definition": "État de calme profond et de paix intérieure."
	},
	{
		"mot": "Désirable",
		"definition": "Qui est très attirant, que l'on veut absolument."
	},
	{
		"mot": "Complice",
		"definition": "Qui participe à quelque chose avec une autre personne dans la confiance et l'affection."
	},
	{
		"mot": "Soutien",
		"definition": "Aide morale et émotionnelle pour quelqu'un."
	},
	{
		"mot": "Fidèle",
		"definition": "Qui reste attaché à une personne ou à un engagement sans faillir."
	},
	{
		"mot": "Merveilleuse",
		"definition": "Qui est d'une beauté extraordinaire."
	},
	{
		"mot": "Pureté",
		"definition": "Caractère de ce qui est pur, sans défaut ni imperfection."
	},
	{
		"mot": "Délicate",
		"definition": "Qui est sensible, raffiné et attentif."
	},
	{
		"mot": "Splendide",
		"definition": "Qui brille par sa beauté et sa magnificence."
	},
	{
		"mot": "Lumineuse",
		"definition": "Qui émet de la lumière, qui brille d'une aura radieuse."
	},
	{
		"mot": "Sincérité",
		"definition": "Caractère de ce qui est vrai, authentique, sans tromperie."
	},
	{
		"mot": "Douceur",
		"definition": "Caractère de ce qui est agréable au contact ou à l'oreille."
	},
	{
		"mot": "Ravissante",
		"definition": "Qui est extrêmement charmant et agréable."
	},
	{
		"mot": "Exubérante",
		"definition": "Qui déborde d'énergie et de joie."
	},
	{
		"mot": "Impeccable",
		"definition": "Qui est parfait, sans défaut."
	},
	{
		"mot": "Courageuse",
		"definition": "Qui a la force de faire face aux défis avec détermination."
	},
	{
		"mot": "Sereine",
		"definition": "Qui est calme, paisible, sans agitation."
	},
	{
		"mot": "Subjugante",
		"definition": "Qui captive, qui charme et envoûte."
	},
	{
		"mot": "Indispensable",
		"definition": "Qui est absolument nécessaire."
	},
	{
		"mot": "Incomparable",
		"definition": "Qui n'a pas d'égal, qui ne peut être comparé à rien d'autre."
	},
	{
		"mot": "Fascinante",
		"definition": "Qui attire l'attention par un charme irrésistible."
	},
	{
		"mot": "Chaleureuse",
		"definition": "Qui manifeste de la chaleur, de l'affection, de l'hospitalité."
	},
	{
		"mot": "Poétique",
		"definition": "Qui évoque des émotions profondes par la beauté et la sensibilité."
	},
	{
		"mot": "Époustouflante",
		"definition": "Qui impressionne au-delà des attentes, qui laisse sans voix."
	},
	{
		"mot": "Impressionnante",
		"definition": "Qui laisse une forte marque par sa grandeur ou sa beauté."
	},
	{
		"mot": "Magnetique",
		"definition": "Qui exerce une attraction irrésistible."
	},
	{
		"mot": "Séraphique",
		"definition": "Qui a une beauté pure et céleste."
	},
	{
		"mot": "Gracieuseté",
		"definition": "Caractère de ce qui est gracieux, élégant et plaisant."
	},
	{
		"mot": "Incontournable",
		"definition": "Qui ne peut être ignoré, essentiel."
	},
	{
		"mot": "Sublimé",
		"definition": "Qui est élevé à un niveau de beauté ou de grandeur exceptionnelle."
	},
	{
		"mot": "Mignonne",
		"definition": "Qui a de la grâce et de la délicatesse."
	},
	{
		"mot": "Paradisiaque",
		"definition": "Qui évoque un paradis, d'une beauté extrême."
	},
	{
		"mot": "Exotique",
		"definition": "Qui est différent, étrange et charmant."
	},
	{
		"mot": "Irremplaçable",
		"definition": "Qui ne peut être remplacé, essentiel et unique."
	},
	{
		"mot": "Pétillante",
		"definition": "Qui est pleine de vivacité et d'énergie."
	},
	{
		"mot": "Subtile",
		"definition": "Qui est délicat, raffiné, perceptible uniquement par des détails fins."
	},
	{
		"mot": "Grenouille",
		"definition": "Batracien aux pattes postérieures longues et palmées, à peau lisse, nageur et sauteur."
	},
	{
		"mot": "Intense",
		"definition": "Qui est d'une grande force ou profondeur émotionnelle."
	},
	{
		"mot": "Inestimable",
		"definition": "Qui a une valeur tellement grande qu'elle ne peut être mesurée."
	},
	{
		"mot": "Ressourçante",
		"definition": "Qui redonne de l'énergie et de la vitalité."
	},
	{
		"mot": "Inouïe",
		"definition": "Qui est si surprenant qu'il semble irréel."
	},
	{
		"mot": "Épanouie",
		"definition": "Qui est dans un état de développement et de bien-être parfait."
	},
	{
		"mot": "Légendaire",
		"definition": "Qui a des qualités extraordinaires, digne d'une légende."
	},
	{
		"mot": "Exceptionnelle",
		"definition": "Qui est hors du commun, qui dépasse les normes habituelles."
	},
	{
		"mot": "Éternelle",
		"definition": "Qui dure toujours, qui n'a pas de fin."
	},
	{
		"mot": "Somptueux",
		"definition": "D'une grande richesse, d'une beauté éclatante."
	},
	{
		"mot": "Dynamique",
		"definition": "Qui est plein d'énergie et d'entrain."
	},
	{
		"mot": "Empathique",
		"definition": "Qui a la capacité de comprendre et de partager les sentiments des autres."
	},
	{
		"mot": "Emouvante",
		"definition": "Qui suscite une émotion profonde."
	},
	{
		"mot": "Sublimée",
		"definition": "Qui a été élevée à un état de beauté ou de grandeur exceptionnelle."
	},
	{
		"mot": "Sculpturale",
		"definition": "Qui a des lignes ou des formes d'une beauté parfaite, digne d'une sculpture."
	},
	{
		"mot": "Téméraire",
		"definition": "Qui prend des risques avec audace, souvent admirable."
	},
	{
		"mot": "Parfaite",
		"definition": "Qui n'a aucun défaut, qui est idéale."
	},
	{
		"mot": "Éclatante",
		"definition": "Qui brille de manière très vive et visible."
	},
	{
		"mot": "Douce",
		"definition": "Qui est tendre, agréable au toucher ou à l'âme."
	},
	{
		"mot": "Charismatique",
		"definition": "Qui exerce une influence irrésistible et attire les autres."
	},
	{
		"mot": "Fière",
		"definition": "Qui est dignement forte et pleine de confiance."
	},
	{
		"mot": "Angélique",
		"definition": "Qui évoque la pureté et la douceur des anges."
	},
	{
		"mot": "Emblématique",
		"definition": "Qui représente parfaitement une idée ou une qualité."
	},
	{
		"mot": "Céleste",
		"definition": "Qui est d'une beauté ou d'une qualité exceptionnelle, divine."
	},
	{
		"mot": "Voluptueuse",
		"definition": "Qui procure un plaisir sensuel intense, pleine de charme."
	},
	{
		"mot": "Magnifique",
		"definition": "Qui est d'une beauté éclatante, exceptionnelle."
	},
	{
		"mot": "Mirifique",
		"definition": "Qui est merveilleux, exceptionnel."
	},
	{
		"mot": "Sensationnelle",
		"definition": "Qui provoque une grande impression, qui est remarquable."
	},
	{
		"mot": "Souriante",
		"definition": "Qui a un sourire qui rayonne de bonheur et de bienveillance."
	},
	{
		"mot": "Envoûtante",
		"definition": "Qui exerce un pouvoir irrésistible sur les sens et l'âme."
	},
	{
		"mot": "Suave",
		"definition": "Qui est doux et agréable, souvent dans un sens séduisant."
	},
	{
		"mot": "Mélodieuse",
		"definition": "Qui a une sonorité agréable, douce et harmonieuse."
	},
	{
		"mot": "Luminescente",
		"definition": "Qui émet de la lumière, brillante dans l'obscurité."
	},
	{
		"mot": "Idéale",
		"definition": "Qui correspond parfaitement à un modèle, à un idéal."
	},
	{
		"mot": "Plénitude",
		"definition": "État de perfection, de satisfaction complète."
	},
	{
		"mot": "Noble",
		"definition": "Qui a une grande dignité, qui inspire le respect."
	},
	{
		"mot": "Élégante",
		"definition": "Qui est d'une grande distinction, raffinée et gracieuse."
	},
	{
		"mot": "Admirable",
		"definition": "Qui mérite l'admiration par sa beauté, sa grandeur ou son caractère."
	}
];

const currentWord = randomWord();
handleWord(currentWord.mot);
totalWordsArea.innerText = words.length;
discoveredWordsArea.innerText = discoveryCount;
definitionArea.innerText = currentWord.definition;

function randomWord() {
	const randomIndex = Math.floor(Math.random() * words.length);
	const word = words[randomIndex];
	return word;
}

function getCookie(name) {
	const cookie = document.cookie.split('; ').find(row => row.startsWith(name + '='));
	return cookie ? decodeURIComponent(cookie.split('=')[1]) : null;
}

function setCookie(name, value, days) {
	let expires = "";
	if (days) {
		const date = new Date();
		date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
		expires = "; expires=" + date.toUTCString();
	}
	document.cookie = name + "=" + encodeURIComponent(value) + expires + "; path=/";
}

function handleWord(mot) {
	if (!discoveredWords.includes(mot)) {
		wordArea.classList.add("text-focus-in");
		definitionArea.classList.add("text-focus-in");
		document.querySelector('body').classList.add('bg');
		discoveredWords.push(mot);
		discoveryCount += 1;
		setCookie('discoveredWords', JSON.stringify(discoveredWords), 30);
		setCookie('counter', discoveryCount, 30);
		console.log(`Mot "${mot}" découvert pour la première fois. Counter incrémenté.`);
	} else {
		console.log(`Le mot "${mot}" a déjà été découvert.`);
	}
}

for(let i = 0; i < currentWord.mot.length; i++) {
	let letter = document.createElement('span')
	letter.innerText = currentWord.mot[i]
	
	letter.addEventListener("mouseenter", (e) => {
		if (!letter.classList.contains("animate")) {
			letter.classList.add("animate");
			setTimeout(
				function () {
					letter.classList.remove("animate");
				}, 0.5 * 1000
			);
		}
	});
	wordArea.appendChild(letter)
}
</script>

</body>
</html>