<template>

    <ul class="nav navbar-nav">
    <li :class="{ active: $parent.isActive('posts') }"> <a v-on:click="$parent.setActive('posts')">Posts</a></li>
    <li :class="{ active: $parent.isActive('oauth') }"> <a v-on:click="$parent.setActive('oauth')">Oauth</a></li>
    </ul>

</template>

<script>

</script>