<template>
    <div class="py-2 border-t border-gray-300 shopping-item">
        <div class="px-1 name">
            {{ item.name }}
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            item: Object,
        }
    }
</script>
