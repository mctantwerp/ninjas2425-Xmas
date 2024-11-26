@extends('layouts.app')

@section('title', 'XMAS | How to Play')

@section('content')
    <window-popup>
        <template v-slot:content>
            <h2>How to play? 🔔</h2>
            <p>1. Find all 4 posters on campus.</p>
            <p>2. Scan the QR code and type in the unique code. Each game has a unique code.</p>
            <p>3. Play the minigames to reveal all 4 words.</p>
            <p>4. Make the secret sentence and submit in the end.</p>
            <p>5. You will have the chance to win a price!</p>
            <p>Are you stuck in a game? Press the “?” on the top right of the screen for a hint. Good luck!</p>
        </template>
    </window-popup>
@endsection
