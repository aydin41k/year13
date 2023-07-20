<template>
    <div class="container py-3">
        <div class="row mb-4">
            <div  class="col-12">
                Please select two Occupations from above and click Compare
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center">
                <div class="form">
                    <div class="form-group row">
                        <div class="padding-x-15">
                            <label>Occupation 1</label>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <select-occupation v-model="occupation_1"></select-occupation>
                        </div>
                    </div>
                    <div class="form-group row">
                      <div class="padding-x-15">
                          <label>Occupation 2</label>
                      </div>
                      <div class="col-12 col-md-6 col-lg-4">
                          <select-occupation v-model="occupation_2"></select-occupation>
                      </div>
                    </div>
                    <div class="form-group row padding-x-15">
                        <button
                            class="btn btn-primary mt-2"
                            @click.prevent="compare"
                            :disabled="!occupation_1 || !occupation_2 || occupation_1.value === occupation_2.value || loading"
                        >
                            <template v-if="loading">
                                <i class="fa fa-refresh fa-spin"></i>
                            </template>
                            <template v-else>
                                Compare
                            </template>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
          <template v-if="loading">
              <div class="col-12">
                Please wait...
              </div>
          </template>
        </div>
        <div>
            <template v-if="match && !loading">
                <Result
                    :occupation_data="occupation_data"
                    :match="match"
                >
                </Result>
            </template>
        </div>
    </div>
</template>

<script>
    import SelectOccupation from '../components/form-controls/SelectOccupation';
    import Result from "../components/Result.vue";
    export default {
        name: 'home-page',
        components: {
            Result,
            SelectOccupation
        },
        data() {
            return {
                loading: false,
                occupation_1: null,
                occupation_2: null,
                occupation_data : {
                    occupation_1: {code: this.occupation_1, name: "Occupation 1", data: null},
                    occupation_2: {code: this.occupation_2, name: "Occupation 2", data: null},
                    setData(occupation, props) {
                        // Loop through the props and assign each one
                        for (let prop in props) {
                            this[occupation][prop] = props[prop];
                        }
                    }
                },
                match: null
            }
        },
        methods: {
            compare() {
                this.loading = true;
                this.axios.post('/api/compare', {
                    occupation_1: this.occupation_1.value,
                    occupation_2: this.occupation_2.value
                }).then((response) => {
                    this.loading = false;
                    this.occupation_data.setData('occupation_1', {
                         code: this.occupation_1.value,
                         name: this.occupation_1.title,
                         data: response.data.occupation_1
                    });
                    this.occupation_data.setData('occupation_2', {
                         code: this.occupation_2.value,
                         name: this.occupation_2.title,
                         data: response.data.occupation_2
                    });
                    this.match = response.data.match;
                }).catch(() => {
                    this.loading = false;
                });
            }
        }
    }
</script>

<style lang="scss" scoped>
    .form-group {
        display: flex;
        align-items: center;

        label {
            text-align: left;
            display: block;
            margin-bottom: 0.2rem
        }
    }
    .padding-x-15 {
      padding-left: 15px;
      padding-right: 15px;
    }
</style>