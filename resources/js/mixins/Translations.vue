<script>
export default{
  data: function () {
    return {
      // hakenLanguages: window.hakenLanguages,
      // sbLang: Translations
    }
  },
  methods: {
    __(key) {

      return  _.get(Translations, key) || key

      // var trans = ''
      //
      // var get = function(obj, key) {
      //   return key.split(".").reduce(function(o, x) {
      //     return (typeof o == "undefined" || o === null) ? o : o[x];
      //   }, obj);
      // }
      //
      // trans = Spark.translations[key];
      // if(trans!=''&&trans!=null) {
      //   return trans
      // }
      // console.log('Translations',Translations)
      // trans = get(Translations.global, key)
      // if(trans!=''&&trans!=null) {
      //   return trans
      // }
      // return key

    },
  },
}
</script>