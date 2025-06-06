<x-app-layout>
    <x-slot name="slot">
        <h1 class="text-center">User edit form</h1>
        <form action="{{ route("userUpdate", $user) }}" method="post">
            @csrf
            @method("patch")
            <label>title:</label>
            <label>name:</label>
            <input type="text" name="name" value="{{ $user->name }}">
            <label>surname</label>
            <input type="text" name="surname" value="{{ $user->surname }}">
            <label>email</label>
            <input type="text" name="email" value="{{ $user->email }}">
            <label>phone</label>
            <input type="text" name="phone" value="{{ $user->phone }}">
            <label>rank</label>
            <input type="text" name="rank" value="{{ $user->rank }}">
            <label>exp</label>
            <input type="text" name="exp" value="{{ $user->exp }}">
            <label>role</label>
            <input type="text" name="role" value="{{ $user->role }}">
            <input type="submit">
        </form>
    </x-slot>
</x-app-layout>