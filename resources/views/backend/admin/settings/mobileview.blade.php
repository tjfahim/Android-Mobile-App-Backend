@extends('backend.layouts.main')

@section('main_content')
<style>
   .mobileView{
        height: 600px;
        width: 320px;
        margin: auto; 
        background-color: rgb(20, 24, 40);
        color: white;
        display: flex;
        flex-direction: column;
        justify-content: center;  /* Center vertically */
        align-items: center;      /* Center horizontally */
        text-align: center; 
   }
   .mediaControl{
    width: 75%;
    background-color: black;
    border-radius: 6px;
    height: 23%;
    font-size: 10px;
    margin: 0;
    padding: 0;
   }




.aPlay {
  padding: 0;
  margin: 0;
  background: none;
  border: none;
  cursor: pointer;
  width: 20%;
}
.aPlay img {
 width: 100%;
 border: none;
 background: none;
 border-radius: 0;
}

.aCron {
  font-size: 14px;
  color: #cbcbcb;
  margin: 0 10px;
}

input[type="range"] {
  appearance: none;
  border: none;
  outline: none;
  box-shadow: none;
  width: 100%;
  padding: 0;
  margin: 0;
  background: 0;
}

.range{
  position: relative;
  display: flex;
  align-items: center;
}
.range input,
input {
    position: relative;
    z-index: 1;
    width: 100%;
}

.range .change-range,
.change-range {
    position: absolute;
    left: 0;
    top: 0;
    height: 3px;
    width: 0px;
    background-color: #336AFB;
    border-radius: 10px;
}

.change-range {
    height: 10px;
    width: calc(100% - 1px); /* Adjusted to match the width of the range input more accurately */
}

.under-ranger {
    position: absolute;
    left: 0;
    top: 0;
    height: 3px;
    width: 100%;
    background-color: rgb(63, 63, 63);
    border-radius: 10px;
}

input[type="range"]::-webkit-slider-thumb {
    appearance: none;
    cursor: pointer;
    width: 1px;
    height: 1px;
    border-radius: 0%;
    border: 0;
    background: #b33b3b00;
    position: relative;
    cursor: pointer;
    margin-top: -5px;
}

input[type="range"]::-moz-range-thumb {
    width: 1px;
    height: 1px;
    border-radius: 0%;
    border: 0;
    background: #ffffff00;
    position: relative;
    cursor: pointer;
    margin-top: -5px;
}

.fa {
    color: white;
}
.aWrap{
    width: 100%
}
.aNow {
    float: left;
}

.aTime {
    float: right;
}
.aSeek{
  cursor: pointer;
  padding: 4px !important;
}

.aPlayIco {
  display: inline-block;
  width: 50px;
  height: 50px;
  border-radius: 50%;
  background-color: #336AFB;
  position: relative;
}

.aPlayIco i {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  font-size: 30px; /* Adjust the font size of the icon */
  color: white; /* Color of the icon */
}
.aPlayIco i.pause-custom {
  position: absolute;
  top: 50%;
  left: 43%;
  transform: translate(-50%, -50%);
  font-size: 30px; /* Adjust the font size of the icon */
  color: white; /* Color of the icon */
}

.aPlay:focus {
  outline: none;
  border: none;
  padding: 0;
  margin: 0;
}



</style>

<div class="content text-center">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body mb-2">
                <div class="mobileView">
                   <div class="pb-4" style="font-size: 12px">
                        Now Live
                    </div>
                   <div class="">
                        <img class="text-center" src="{{ asset('image/dashboard/20240115104151_WhatsApp Image 2024-01-10 at 16.11.04_e991fa0c.jpg') }}" id="imagePreview" style="width: 200px; height: 200px;background:white;border-radius:100px;border:none">
                    </div>
                    <div class="my-2">
                        <h4 class="mb-0 mt-0">
                            Hay Libarted
                         </h4>
                         <span style="font-size: 10px; color:#a4a4a4">
                             Rivara Candelita
                         </span>
                    </div>
                   <div class="mb-2" style="width: 100%">
                    <div id="lottie-container" style="width: 100%;"></div>
                  </div>
          
                    <div class="mediaControl row">
                     
<div class="aWrap" data-src="https://ia800905.us.archive.org/19/items/FREE_background_music_dhalius/backsound.mp3">
    <div class="aCron pt-3" style="font-size:9px">
        <span class="aNow "></span><span class="aTime"></span>
      </div>
    <div class="range mt-3 mx-2">
        <span class="under-ranger"></span>
        <input class="aSeek" type="range" min="0" value="0" step="1" disabled><span class="change-range"></span>
      </div>
      <button class="aPlay mt-2 " onclick="togglePlayPause()" disabled>
        <span class="aPlayIco"> <i class="fa fa-play" aria-hidden="true"></i>  </span>

    </button>   
    <div class="mt-1" style="width: 100%">
      <div style="display: inline-block; width:35%; float:left; margin-left:-5%;">
        <img style="width: 16px;margin-top: -8px;"  src="{{ asset("image/dashboard/WhatsApp_Image_2024-01-21_at_15.53.55_c4129067-removebg-preview.png") }}" alt="">
          <span style="margin-left: 1px; font-size:8px">23</span>
      </div>
      <div style="display: inline-block; width:35%; float:left;">
          <i style="font-size: 13px; color:#445982;" class="fa fa-share" aria-hidden="true"></i><span style="margin-left: 1px; font-size:8px">Share</span>
      </div>
      <div style="display: inline-block; width:35%; float:left;">
          <i style="font-size: 13px;" class="fa fa-apple" aria-hidden="true"></i><span style="margin-left: 1px; font-size:8px">23</span>
          <i style="font-size: 14px; color:#A6D963" class="fa fa-android" aria-hidden="true"></i><span style="margin-left: 1px; font-size:8px">2</span>
      </div>
  </div>
  </div>



</div>

                    </div>
                </div>
            </div>
            
        </div>
    </div>
    
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.7.5/lottie.min.js"></script>

<script>
  const animationContainer = document.getElementById('lottie-container');
    const animationData = '{{ asset("image/dashboard/musiclottieani.json") }}';  // Replace with the actual path

    const animation = lottie.loadAnimation({
        container: animationContainer,
        renderer: 'svg',
        loop: true,
        autoplay: false, // Set autoplay to false initially
        path: animationData,
    });

    var audioElement;
    function timeString(secs) {
        let ss = Math.floor(secs),
            hh = Math.floor(ss / 3600),
            mm = Math.floor((ss - hh * 3600) / 60);
        ss = ss - hh * 3600 - mm * 60;

        if (hh > 0) {
            mm = mm < 10 ? "0" + mm : mm;
        }
        ss = ss < 10 ? "0" + ss : ss;
        return hh > 0 ? `${hh}:${mm}:${ss}` : `${mm}:${ss}`;
    }

    function setProgress(elTarget) {
        let divisionNumber = elTarget.getAttribute("max") / 100;
        let rangeNewWidth = Math.floor(elTarget.value / divisionNumber);
        if (rangeNewWidth > 100) {
            elTarget.nextSibling.style.width = "100%";
        } else {
            elTarget.nextSibling.style.width = rangeNewWidth + "%";
        }
    }

    function toggleAnimationAndAudio() {
        if (audioElement.paused) {
            audioElement.play();
            animation.play();
        } else {
            audioElement.pause();
            animation.pause();
        }
    }
for (let i of document.querySelectorAll(".aWrap")) {
  i.audio = new Audio(encodeURI(i.dataset.src));
  (i.aPlay = i.querySelector(".aPlay")),
    (i.aPlayIco = i.querySelector(".aPlayIco")),
    (i.aNow = i.querySelector(".aNow")),
    (i.aTime = i.querySelector(".aTime")),
    (i.aSeek = i.querySelector(".aSeek")),
    (i.aVolIco = i.querySelector(".aVolIco"));
  i.seeking = false; 
  i.aPlay.onclick = () => {
    if (i.audio.paused) {
      i.audio.play();
    } else {
      i.audio.pause();
    }
  };

        i.aPlay.onclick = () => {
            toggleAnimationAndAudio();
        };
  // i.audio.onplay = () => (i.aPlayIco.innerHTML = '<img src={{ asset('image/dashboard/pause-flat.png') }}>');
  // i.audio.onpause = () => (i.aPlayIco.innerHTML = '<img src={{ asset('image/dashboard/play-flat.png') }}>');
  // i.audio.onplay = () => (i.aPlayIco.innerHTML = '<i class="fa fa-pause pause-custom" aria-hidden="true"></i>');
  // i.audio.onpause = () => (i.aPlayIco.innerHTML = '<i class="fa fa-play " aria-hidden="true"></i>');

  i.audio.onplay = () => {
            i.aPlayIco.innerHTML = '<i class="fa fa-pause pause-custom" aria-hidden="true"></i>';
            animation.play();
        };

        i.audio.onpause = () => {
            i.aPlayIco.innerHTML = '<i class="fa fa-play " aria-hidden="true"></i>';
            animation.pause();
        };

  i.audio.onloadstart = () => {
  if (i.audio.paused) {
    i.aNow.innerHTML = "Loading";
    i.aTime.innerHTML = "";
  }
};

  
  i.audio.onloadedmetadata = () => {
   
    i.aNow.innerHTML = timeString(0);
    i.aTime.innerHTML = timeString(i.audio.duration);

    
    i.aSeek.max = Math.floor(i.audio.duration);

    i.aSeek.oninput = () => (i.seeking = true);
    i.aSeek.onchange = () => {
      i.audio.currentTime = i.aSeek.value;
      if (!i.audio.paused) {
        i.audio.play();
      }
      i.seeking = false;
    };

    i.audio.ontimeupdate = () => {
      if (!i.seeking) {
        i.aSeek.value = Math.floor(i.audio.currentTime);
      }
      i.aNow.innerHTML = timeString(i.audio.currentTime);
      let divisionNumber = i.aSeek.getAttribute("max") / 100;
      let rangeNewWidth = Math.floor(i.aSeek.value / divisionNumber);
      if (rangeNewWidth > 100) {
        i.aSeek.nextSibling.style.width = "100%";
      } else {
        i.aSeek.nextSibling.style.width = rangeNewWidth + "%";
      }
    };
  };

 
  i.audio.oncanplaythrough = () => {
            i.aPlay.disabled = false;
            i.aSeek.disabled = false;
        };

        i.audio.onwaiting = () => {
            i.aPlay.disabled = true;
            i.aSeek.disabled = true;
        };

        i.aSeek.addEventListener("input", function () {
            setProgress(this);
        });

        // Set the audioElement variable to the current audio element
        audioElement = i.audio;

        // Pause the audio and animation initially
        i.audio.pause();
        animation.pause();
    
}

</script>
   
@endsection