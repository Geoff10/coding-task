<template>
    <div class="py-2 border-t border-gray-300 shopping-item">
        <form @submit.prevent="addItem()" class="px-1 item-name flex items-center">
            <div class="mr-4">
                <form-input class="" id="new-item-name" name="new_item_name" placeholder="Item" v-model="item.name"></form-input>
                <div v-if="errors.name" class="text-red-600 text-sm">{{ errors.name }}</div>
            </div>
            <form-button type="submit" id='new-item-submit'>Add</form-button>
        </form>
    </div>
</template>

<script>
    import FormInput from '@/Components/Input'
    import FormButton from '@/Components/Button'

    export default {
        emits: ['AddItem'],

        props: {
            errors: Object,
        },

        components: {
            FormInput,
            FormButton,
        },

        data() {
            return {
                item: {
                    name: '',
                    purchased: false,
                },
            }
        },

        methods: {
            clearItem() {
                this.item = {
                    name: '',
                    purchased: false,
                }
            },
            addItem() {
                this.$inertia.post('/items', this.item, {
                    onSuccess: page => {
                        this.clearItem();
                    },
                });
            }
        }
    }
</script>
