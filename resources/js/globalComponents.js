import Vue from 'vue';
import Header from './components/Header.vue';
import BaseInput from './components/BaseInput.vue';
import BaseSelect from './components/BaseSelect.vue';
import BaseButton from './components/BaseButton.vue';
import VModal from 'vue-js-modal'


Vue.component('frontend-header', Header );
Vue.component('BaseInput', BaseInput );
Vue.component('BaseSelect', BaseSelect );
Vue.component('BaseButton', BaseButton );

Vue.use(VModal)