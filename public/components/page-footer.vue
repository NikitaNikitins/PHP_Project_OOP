<template>
    <div id="container">
    <div id="contacts">
      <div id="contacts--contact">
        <p>{{ mail }}</p>
        <p>{{ phone }}</p>
        <p>{{ name }}</p>
        <p>Github: {{ github }}</p>
      </div>
      <div id="contacts--social">
        <div></div>
        <div></div>
        <div></div>
      </div>
    </div>
    <div id="mentions">
      <p>{{ mention }}</p>
    </div>
   </div>
</template>

<script>
export default {
    data() {
        return{
            mail : 'giinger11352@gmail.com',
            name: 'Nikita Nikitins',
            github: 'https://github.com/NikitaNikitins/PHP_Project_OOP/tree/master',
            phone : '+371 203 17 330',
            mention : '2021 | United Group'
    }
    }
}
</script>
