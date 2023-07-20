<template>
    <div class="mt-4">
        <h4>Importance of different skills for each occupation selected</h4>
        <table class="table table-striped table-bordered table-hover mt-2">
            <caption>
              Comparison of the skills of the two occupations
            </caption>
            <thead class="thead-dark">
              <tr class="d-flex">
                <th class="col-8 d-flex align-items-center">Skill</th>
                <th class="col-2 d-flex align-items-center">{{ occupation_data.occupation_1.name }}</th>
                <th class="col-2 d-flex align-items-center">{{ occupation_data.occupation_2.name }}</th>
              </tr>
            </thead>
            <tbody>
              <tr class="d-flex" v-for="skill in this.skills">
                <td class="col-8">{{ skill }}</td>
                <td class="col-2">{{ occupation_data.occupation_1.data[skill] || 0}}</td>
                <td class="col-2">{{ occupation_data.occupation_2.data[skill] || 0}}</td>
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