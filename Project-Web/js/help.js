var qcontainer = document.querySelector('#helpNav');
var currentq = qcontainer.getElementsByClassName('fq_division');


for (var i = 0; i < currentq.length; i++) {
	currentq[i].addEventListener('click', function change_que(){
		var activeq = document.getElementsByClassName('active');
		activeq[0].className = activeq[0].className.replace('active','');
		this.className += ' active';
	});

}
