<template>
    <el-header height="auto" class="search">
        <el-form
            :model="form"
            :rules="rules"
            ref="form"
            status-icon
            label-position="left"
            label-width="120px"
        >
            <el-form-item label="Name" prop="name">
                <el-input v-model="form.name" autocomplete="off"></el-input>
            </el-form-item>

            <el-form-item label="Bedrooms" prop="bedrooms">
                <el-input
                    v-model="form.bedrooms"
                    type="number"
                    autocomplete="off"
                ></el-input>
            </el-form-item>

            <el-form-item label="Bathrooms" prop="bathrooms">
                <el-input
                    v-model="form.bathrooms"
                    type="number"
                    autocomplete="off"
                ></el-input>
            </el-form-item>

            <el-form-item label="Storeys" prop="storeys">
                <el-input
                    v-model="form.storeys"
                    type="number"
                    autocomplete="off"
                ></el-input>
            </el-form-item>

            <el-form-item label="Garages" prop="garages">
                <el-input
                    v-model="form.garages"
                    type="number"
                    autocomplete="off"
                ></el-input>
            </el-form-item>

            <el-form-item label="Price" prop="price">
                <el-col :span="12">
                    <el-input
                        v-model="form.price[0]"
                        type="number"
                        autocomplete="off"
                    ></el-input>
                </el-col>
                <el-col :span="12">
                    <el-input
                        v-model="form.price[1]"
                        type="number"
                        autocomplete="off"
                    ></el-input>
                </el-col>
            </el-form-item>

            <el-form-item>
                <el-button @click="resetForm">Reset</el-button>
            </el-form-item>
        </el-form>
    </el-header>
</template>

<script>
import axios from 'axios';

export default {
    name: 'Search',
    data() {
        return {
            form: {
                name: '',
                bedrooms: '',
                bathrooms: '',
                storeys: '',
                garages: '',
                price: ['', ''],
            },
            rules: {
                price: [{ validator: checkPrice, trigger: 'blur' }],
            },
        };
    },
    methods: {
        submitForm(form) {
            this.$refs['form'].validate(async valid => {
                if (!valid) return;
                this.$emit('loading');
                const { data } = await axios.post('/api/search', form);
                this.$emit('data', data);
                this.$emit('loading');
            });
        },
        resetForm() {
            this.$refs['form'].resetFields();
        },
    },
    watch: {
        form: {
            handler: 'submitForm',
            deep: true,
        },
    },
};

function checkPrice(_, value, cb) {
    if (!value[0] || !value[1]) {
        cb();
    }

    if (+value[0] > +value[1]) {
        cb(new Error('Max price cannot be less than min price'));
    }

    cb();
}
</script>

<style scoped>
.search {
    margin-top: 1rem;
}
</style>
