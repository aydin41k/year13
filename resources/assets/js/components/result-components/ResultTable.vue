<template>
    <div class="subsection-container">
        <div class="subheader">Importance of different skills for the selected occupations</div>
        <table class="table table-bordered table-hover mt-2">
            <caption>
              Comparison of the skills of the two occupations
            </caption>
            <thead>
              <tr class="d-flex">
                <th class="col-6 col-md-8 d-flex align-items-center">Skills</th>
                <th class="col-3 col-md-2 d-flex align-items-center">{{ occupation_data.occupation_1.name }}</th>
                <th class="col-3 col-md-2 d-flex align-items-center">{{ occupation_data.occupation_2.name }}</th>
              </tr>
            </thead>
            <tbody>
              <tr class="d-flex" v-for="skill in this.skills">
                <td class="col-6 col-md-8">{{ skill }}</td>
                <td class="col-3 col-md-2">{{ occupation_data.occupation_1.data[skill] || 0}}</td>
                <td class="col-3 col-md-2">{{ occupation_data.occupation_2.data[skill] || 0}}</td>
              </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        props: {
            occupation_data: Object,
        },
        methods: {
            consolidateSkills() {
                const set1 = this.occupation_data.occupation_1.data;
                const set2 = this.occupation_data.occupation_2.data;

                for (let skill in set1) {
                  if (!this.skills.includes(skill)) {
                    this.skills.push(skill);
                  }
                }

                for (let skill in set2) {
                  if (!this.skills.includes(skill)) {
                    this.skills.push(skill);
                  }
                }

                // Sort this.skills alphabetically
                this.skills.sort();
            }
        },
        data() {
            return {
                skills: [],
            }
        },
        created() {
            this.consolidateSkills();
        }
    }
</script>

<style scoped>
    table {
      font-size: 0.7em;
    }
    th {
      border-color: rgb(1,51,143);
    }
    thead {
      background-color: rgb(1,51,143);
      color: white;
    }
    @media screen and (min-width: 768px) {
      table {
        font-size: 1em;
      }
    }
</style>