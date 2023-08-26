<template>
    <div class="z-2">
        <div>
            <img
                src="/assets/logo.png"
                alt="Logo"
                class="image-center max-w-5rem max-h-5rem"
            >
        </div>

<!--        <Menubar ref="menu" id="overlay_menu" :model="items" :popup="true">-->
<!--            <template #end>-->
<!--                <InputText placeholder="Search" type="text" />-->
<!--            </template>-->
<!--        </Menubar>-->
    </div>
</template>

<script setup>
    import {onBeforeMount, ref} from "vue";
    import InputText from 'primevue/inputtext';
    import Menubar from 'primevue/menubar';
    // import {useSecurityStore} from "@/store/security-store";
    //
    // const securityStore = useSecurityStore();

    const user = ref(null);
    const menu = ref();
    const items = ref([
        {
            label: 'Home',
            icon: 'pi pi-fw pi-home'
        },
        {
            label: 'Account',
            icon: 'pi pi-fw pi-user',
            items: [
                {
                    label: 'Instellingen',
                    icon: 'pi pi-fw pi-cog'
                },
                {
                    label: 'Uitloggen',
                    icon: 'pi pi-fw pi-power-off'
                }
            ]
        },
    ]);

    // onBeforeMount(async () => {
    //     user.value = await securityStore.getUser();
    // });
    //
    // function logout() {
    //     securityStore.logout();
    //
    //     // window.location.reload();
    // }
</script>
