@extends('layouts.app')

@section('title', 'XMAS | How to Play')

@section('navbar')
    <navbar navbar-title='How To Play'></navbar>
@endsection

@section('content')
    <window-popup>
        <template v-slot:content>
            <h2>How to play? 🔔</h2>
            <p>1. Explore your campus of choice (Hoboken, Zuid or Groenplaats) and locate all 4 posters. Each campus has its
                own set
                of 4
                posters!</p>
            <p>2. Scan the QR code on each poster and enter the unique code provided. The code unlocks a special game.</p>
            <p>3. Complete each minigame to uncover a hidden word. You’ll need all 4 words to proceed.</p>
            <p>4. Arrange the words to create the secret sentence and <a href="/submit" class="clear-link">submit</a> it
                through the website.</p>
            <p>5. Don’t forget to enter your email for a chance to win a prize!</p>
            <p>If you’re stuck on a game, click the “?” in the top-right corner for a helpful hint.</p>
            <p>Good luck!</p>
        </template>
    </window-popup>

@endsection
