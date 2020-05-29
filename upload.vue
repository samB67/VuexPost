<template>
    <div class="container">
        <h2>Set new tasks here</h2><br>
        <div class="">
            <label class="typo__label">Set task to</label>
            <multiselect v-model="value" :max-height="0"  :options="options" :searchable="false" :multiple="true" group-label="language" track-by="name" label="name" placeholder=""><span class="arrow" slot="caret"></span></multiselect>
<!--            <pre class="language-json"><code>{{ value }}</code></pre>-->
        </div>
        <br>
        <div class="">
            <p>You can also choose from your lists of classes and students.</p>
        <div class="card text-center w-50">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item" v-for="tab in tabs">
                        <div class="nav-link btn" role="button" v-bind:class="['tab-button', { active: currentTab === tab.componentName }]" v-on:click="currentTab = tab.componentName">{{ tab.DisplayName }}</div>
                    </li>
                </ul>
            </div>
            <div class="card-body p-0 pt-1 overflow-auto">
<!--                <ul class="list-group list-group-flush text-left border-0">-->
<!--                    <li class="list-group-item border-0 cursor-pointer" v-for="item in options[0].libs" :key="item.name" @click="addItem(item.name)"><button type="button" class="btn btn-none px-4">{{ item.name }}</button></li>-->
<!--                </ul>-->
                <component v-bind:is="currentTabComponent" @AddItem="AddItem($event)" class="tab"></component>
            </div>
        </div>
        </div>
        <br>
        <div class="form-group">
            <label for="formGroupExampleInput">Task Title</label>
            <input v-model="HomeworkTitle" type="text" class="form-control" id="formGroupExampleInput" placeholder="Enter text">
        </div>
        <br>
        <label for="set_date">Set Date</label>
        <datepicker id="set_date" name="set_date"></datepicker>
        <br>
        <button class="btn btn-primary col-12 my-4" @click="postHandler">Submit homework</button>
    </div>
</template>

<script>
    import 'quill/dist/quill.core.css'
    import 'quill/dist/quill.snow.css'
    import 'quill/dist/quill.bubble.css'
    import 'vue2-dropzone/dist/vue2Dropzone.min.css'

    import Multiselect from 'vue-multiselect'
    import Datepicker from 'vuejs-datepicker';
    import { quillEditor } from 'vue-quill-editor'
    import vue2Dropzone from 'vue2-dropzone'
    import TestComponent from "../TestComponent";
    import AllClasses from "./SearchFilters/AllClasses";
    import TeacherClasses from "./SearchFilters/TeacherClasses";
    import TeacherCustomGroups from "./SearchFilters/TeacherCustomGroups";


    export default {
        name: "SetNewHomework",

        components: {
            Multiselect,
            Datepicker,
            quillEditor,
            vueDropzone: vue2Dropzone,
            TestComponent,
            AllClasses,
            TeacherClasses,
            TeacherCustomGroups
        },

        data() {
            return {
                content: '',
                options: [],
                value: [],
                isTouched: false,
                currentTab: "TeacherClasses",
                tabs: [
                    {
                        DisplayName: "My Classes",
                        componentName: "TeacherClasses"
                    },
                    {
                        DisplayName: "All Classes",
                        componentName: "AllClasses"
                    },
                    {
                        DisplayName: "Custom",
                        componentName: "TeacherCustomGroups"
                    }
                    ],
            }
        },
        computed: {
            currentTabComponent: function() {
                return this.currentTab;
            },
            HomeworkTitle: {
                get() {
                    return this.$store.getters.HomeworkTitle;
                },
                set(HomeworkTitle) {
                    this.$store.commit('postTitle', HomeworkTitle);
                },
            },
        },
        methods: {
            AddItem(item) {
                this.value.push({name: item})
            },
            postHandler() {
                this.$store.dispatch('createHomework', this.payload);
            },
        }
    }
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style scoped>

</style>
