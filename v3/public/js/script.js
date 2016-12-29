
const api_endpoints = {
    explore:"api/explore",
    search:function (query) {
      return "api/search/"+query;
    }
}
var app = new Vue({
  el: '#app',
  data: {
    search: '',
    tracks:[]
  },
  methods:{
    fetchTracks:function () {
      let vm =this;
      vm.$http.get(api_endpoints.explore).then((result) => {
          vm.tracks = result.body;
      }, (error) => {

      });
    },
    searchTracks:function () {
      let vm =this;
      vm.$http.get(api_endpoints.search(vm.search)).then((result) => {
          vm.tracks = result.body;
      }, (error) => {

      });
    }
  },
  filters:{
    truncate:function (word,len,placeholder) {
      if(word){
        return (word.length > len-1) ? word.substring(0,len) + placeholder : word;
      }
      return '';
    },
    urlencode:function (url) {
      return  encodeURI(url);
    }
  },
  mounted:function () {
    let vm =this;
    vm.fetchTracks();
  }
});
