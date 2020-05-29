const state = {
    postTitle: '',
};

const getters = {
     HomeworkTitle: state => {
         return state.postTitle;
     }
};

const actions = {
    createHomework({commit, state}) {

        axios.post('/api/homework', {
            homework_title: state.postTitle,
        })
            .then(res => {
                commit('updateHomework', '');
            })
            .catch(error => {
                console.log(error);
            });
    },
};

const mutations = {
     postTitle(state, newtitle) {
         state.postTitle = newtitle;
     }

};

export default {
    state, getters, actions, mutations,
}
