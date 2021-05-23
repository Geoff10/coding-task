<template>
    <div class="py-2 border-t border-gray-300 flex items-center shopping-item">
        <checkbox v-model="item.purchased"></checkbox>
        <div class="px-2 flex-grow">
            <span class="name" :class="{'line-through': item.purchased}">{{ item.name }}</span>
            <a class="text-red-600 delete-btn inline-block ml-4 hover:underline hover:cursor-pointer" @click="deleteItem()">Delete</a>
        </div>
    </div>
</template>

<script>
    import Checkbox from '@/Components/Checkbox';

    export default {
        components: {
            Checkbox,
        },

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
