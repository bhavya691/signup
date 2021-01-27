<?php
	session_start();
	if(!isset($_SESSION['name'])){
		header("location:login.php");
	}

?>
<html>
<head>
	<title>Music player</title>
	<?php include 'linkofmusic.php' ?>  
      <?php include 'style.css' ?>


</head>
<body>

<div id="song">
<div id="main">
<div id="music">
	<a href="logout.php"><button>log out</button></a>
		<h2 id="php"><?php echo $_SESSION['name']; ?></h2>
	<h1 id="name">Mere Rashke Quamar</h1>
	<h3 id="singer">Bhavya Raj Deora</h3>
	<div class="volume">
	<i class="fas fa-volume-up" id="volume"></i>
	</div>
	<div id="image">
		<img src="deora-1.jpg">
	</div>
	<audio src="deora-1.mp3" ></audio>
	<div class="bar-container" id="bar-container">
		<div class="bar-meter">
			<div id="current">00:00</div>
			<div id="duration">04 : 00</div>
		</div>
		<div class = "progress-div" id="progress-div">

		<div class="progress" id="progress"></div>
		</div>

	 </div>

	<div id="controls">

	<i class="fas fa-backward" id = "prev" title="previous"></i>
	<i class="fas fa-play btn" id = "play" ></i>
	<i class="fas fa-forward" id = "next" title="next"></i>

</div>
</div>
</div>

</div>

<script>
	const image =  document.querySelector("img");
	const music = document.querySelector("audio");
	const play = document.getElementById("play");
	const title = document.getElementById("name");
	const singer = document.getElementById("singer");
	const prev = document.getElementById("prev");
	const next = document.getElementById("next");
	const progress = document.getElementById("progress");
	const current_time = document.getElementById("current");
	let duration_time = document.getElementById("duration");
	const sound = document.getElementById("volume")

	const progress_div = document.getElementById("progress-div")

	const musics = [
	{
		name:"deora-1",
		title:"Mere Rashke Quamar",
		singer:"Bhavya Raj Deora",
	},
	{
		name:"deora-2",
		title:"tu wafa hai meri",
		singer:"Bhavya Raj",

	},
	{
		name:"deora-3",
		title:"tu ashiqui",
		singer:"Bhavya",
	},
	]

	let playing = false;

	const playMusic = () =>{
		playing = true;
		music.play();
		play.classList.replace('fa-play' , 'fa-pause');
		image.classList.add('anime');
	}

	const pauseMusic = () =>{
		playing = false;
		music.pause();
		play.classList.replace('fa-pause' , 'fa-play');
		image.classList.remove('anime');
	}

	play.addEventListener('click' , () => {
		if(playing){
			pauseMusic();
		}

		else{
			playMusic();
		}
	})

	const loadMusic = (musics) => {
		title.textContent = musics.title;
		singer.textContent = musics.singer;
		music.src = musics.name + ".mp3";
		image.src = musics.name + ".jpg";
		}

	 musicIndex = 0;
	

	const nextMusic = () => {
		musicIndex = (musicIndex + 1) % musics.length;
		loadMusic(musics[musicIndex]);
		playMusic();
	}
	

	const prevMusic = () => {
		musicIndex = (musicIndex - 1 + musics.length) % musics.length;
		loadMusic(musics[musicIndex]);
		playMusic();
	}

	music.addEventListener("timeupdate" , (event) =>{
		const { currentTime , duration } = event.srcElement;
	
		let time = (currentTime/duration) * 100 ;
		progress.style.width = `${time}%`;

		// total time
		let m_duration = Math.floor(duration/60);
		let s_duration = Math.floor(duration%60);
	
		if(m_duration<10){
			m_duration = `0${m_duration}`;
		}

		if(s_duration<10){
				s_duration = `0${s_duration}`;
			}
			let total = `${m_duration} : ${s_duration}`;

			if(duration){
				duration_time.textContent = `${total}`;
			}
				// current time

					let m_current = Math.floor(currentTime/60);
		let s_current = Math.floor(currentTime%60);
	
			if(s_current<10){
				s_current = `0${s_current}`;
			}

			if(m_current<10){
				m_current = `0${m_current}`;
			}

			let now = `${m_current} : ${s_current}`;
			
			
				current_time.textContent = `${now}`;
		
			
	});

	progress_div.addEventListener('click',(event) =>{
		const { duration } = music;

		let pro = (event.offsetX/event.srcElement.clientWidth) * duration;
		music.currentTime = pro;
	});

	let vol = true;

const yes = () =>{
			vol = true;
		sound.classList.replace('fa-volume-up' , 'fa-volume-mute' );
		music.volume = 0.0;
	}

	const mute = () =>{
		vol = false;
		sound.classList.replace('fa-volume-mute' , 'fa-volume-up');
		music.volume = 1.0;
	}

		

		sound.addEventListener('click' , () =>{
			if(vol){
		  mute();
	}

	else{
	  
	    yes();
	}

		})
	

	music.addEventListener("ended" , nextMusic);

		next.addEventListener("click" , nextMusic);
	prev.addEventListener('click' , prevMusic);




    var fizzbuzz = [];
    var k = 1;

    function fiz(){
    while(k<=100){

        if((k%3) == 0 && (k%5) == 0){
        	fizzbuzz.push("fizzbuzz");
    	
    	}else if((k%3) == 0){
    	  fizzbuzz.push("fizz");
    	}else if((k%5) == 0){
    		fizzbuzz.push("buzz");
    	
    	}else{
    		fizzbuzz.push(k);
    	}

 	k++;

    }
     	console.log(fizzbuzz);
}

fiz();

</script>
</body>
</html>