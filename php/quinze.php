<script type="text/javascript">
var tempo = 16;
function aguarda() {
if (tempo > 0) {
	var el = document.getElementById("inicio");
		if( el ){
			secondscamp = parseInt(tempo / 1 - 1);
			hours2 = parseInt(secondscamp / 3600);
			secondscamp = secondscamp % 3600;
			minutes2 = parseInt(secondscamp / 60);
			secondscamp = secondscamp % 60;
			if(secondscamp < 10){el.innerHTML = "" + minutes2 + secondscamp + ""}else{el.innerHTML = "" + secondscamp + ""}
		}
		tempo = tempo - 1
		setTimeout("aguarda()", 1000);
		}}
aguarda();
</script>
<script type="text/javascript">
var tempoj = 16;
function aguardaj() {
if (tempoj > 0) {
	var elj = document.getElementById("inicioj");
		if( elj ){
			secondscampj = parseInt(tempoj / 1 - 1);
			hours2j = parseInt(secondscampj / 3600);
			secondscampj = secondscampj % 3600;
			minutes2j = parseInt(secondscampj / 60);
			secondscampj = secondscampj % 60;
			if(secondscampj < 10){elj.innerHTML = "" + minutes2j + secondscampj + ""}else{elj.innerHTML = "" + secondscampj + ""}
		}
		tempoj = tempoj - 1
		setTimeout("aguardaj()", 1000);
		}}
aguardaj();
</script>