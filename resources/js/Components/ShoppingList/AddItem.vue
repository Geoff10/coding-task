<template>
    <div class="py-2 border-t border-gray-300 shopping-item">
        <div class="px-1 item-name">
            <form-input class="flex-grow mr-4" id="new-item-name" name="new_item_name" placeholder="Item" v-model="item.name"></form-input>
            <form-button id='new-item-submit' @click="addItem()">Add</form-button>
        </div>
    </div>
</template>

<script>
    import FormInput from '@/Components/Input'
    import FormButton from '@/Components/Button'

    export default {
        emits: ['AddItem'],

        components: {
            FormInput,
            FormButton,
        },

        data() {
            return {
                item: {
                    name: '',
                }
            }
        },

        methods: {
            clearItem() {
                this.item = {
                    name: '',
                }
            },
            addItem() {
                this.$emit('addItem', this.item);
                this.clearItem();
            }
        }
    }
</script>
