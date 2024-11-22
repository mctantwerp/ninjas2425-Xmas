@extends('layouts.app')

@section('title', 'XMAS | Submit')

@section('content')
    <submit-popup>
        <template v-slot:content>
            <h2>Submit sentence</h2>
            <p>In the input field below, enter the sentence you found and see if you won!</p>
        </template>
        <template v-slot:action>Submit</template>
    </submit-popup>
@endsection
