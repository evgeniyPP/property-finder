<template>
    <el-container direction="vertical">
        <Search />
        <Results />
    </el-container>
</template>

<script>
import Search from './Search';
import Results from './Results';

export default {
    name: 'App',
    components: {
        Search,
        Results,
    },
};
</script>
