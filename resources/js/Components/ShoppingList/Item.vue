<template>
    <div class="py-2 border-t border-gray-300 shopping-item">
        <div class="px-1">
            <span class="name">{{ item.name }}</span>
            <a class="text-red-600 delete-btn inline-block ml-4 hover:underline hover:cursor-pointer" @click="deleteItem()">Delete</a>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            item: Object,
        },

        methods: {
            deleteItem() {
                this.$emit('deleteItem', this.item);
            }
        }
    }
</script>
