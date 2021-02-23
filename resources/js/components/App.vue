<template>
    <el-container direction="vertical">
        <Search @data="setData" @loading="toggleLoading" />
        <Results :data="data" :loading="loading" />
    </el-container>
</template>

<script>
import axios from 'axios';
import Search from './Search';
import Results from './Results';

export default {
    name: 'App',
    components: {
        Search,
        Results,
    },
    data() {
        return {
            data: [],
            loading: false,
        };
    },
    methods: {
        setData(data) {
            this.data = data;
        },
        toggleLoading() {
            this.loading = !this.loading;
        },
    },
    async beforeMount() {
        this.toggleLoading();
        const { data } = await axios.post('/api/search', {});
        this.data = data;
        this.toggleLoading();
    },
};
</script>
