@extends('layouts.app')

@section('title', 'XMAS | How to Play')

@section('content')
    <window-popup>
        <template v-slot:content>
            <h2>How to play? 🔔</h2>
            <p>1. Find all 4 posters on campus.</br>
                2. Scan the QR code and type in the unique code. Each game has a unique code.</br>
                3. Play the minigames to reveal all 4 words.</br>
                4. Make the secret sentence and submit in the end.</br>
                5. You will have the chance to win a price!</br>
            </p>
            <p>Are you stuck in a game? Press the “?” for a hint. Good luck!</p>
            </p>
        </template>
    </window-popup>
@endsection
