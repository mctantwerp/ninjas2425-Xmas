@extends('layouts.app')

@section('title', 'XMAS | Rebus')

@section('content')
    <first-popup>
        <template v-slot:content>
            <h2>Rebus</h2>
            <p>Can you figure out what message is encoded in these images? Find the secret two words!</p>
        </template>
        <template v-slot:action>Continue</template>
    </first-popup>
@endsection
