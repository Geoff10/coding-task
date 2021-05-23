<template>
    <div class="py-2 border-t border-gray-300 flex items-center shopping-item">
        <checkbox v-model="item.purchased" :checked="item.purchased"></checkbox>
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

        watch: {
            purchased() {
                this.$inertia.put('/items/' + this.item.id, this.item);
            }
        },

        props: {
            item: Object,
        },

        computed: {
            purchased() {
                return this.item.purchased;
            }
        },

        methods: {
            deleteItem() {
                this.$inertia.delete('/items/' + this.item.id);
            }
        }
    }
</script>
