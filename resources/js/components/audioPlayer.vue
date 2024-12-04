<template>
    <div class="audio-wrapper">
        <audio id="custom-audio-player" controls>
            <source src="/public/sfx/mct-christmas-song.mp3" type="audio/mp3" />
        </audio>
    </div>
</template>

<script>
import Plyr from 'plyr';
import 'plyr/dist/plyr.css';

export default {
    mounted() {
        const player = new Plyr('#custom-audio-player');
        //player.play();
    }
}
</script>

<style lang="scss">
@import "../../sass/_variables.scss";

.audio-wrapper {
    position: fixed;
    bottom: 0px;
    left: 50%;
    transform: translateX(-50%);
    min-width: 320px;
    width: 80%;
}

:root {
    --plyr-color-main: #{$illustrations-green};
}
</style>