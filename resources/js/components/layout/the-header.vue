<template>
    <div class="sticky top-0 block md:hidden card flex justify-content-end">
        <Button
            icon="pi pi-bars"
            text
            aria-haspopup="true"
            aria-controls="overlay_menu"
            class="mt-2"
            @click="toggle"
        />

        <Menu
            ref="menu"
            id="overlay_menu"
            :model="items"
            :popup="true"
        />
    </div>
<!--    <div class="z-2">-->
<!--        <div>-->
<!--            <img-->
<!--                src="/assets/logo.png"-->
<!--                alt="Logo"-->
<!--                class="image-center max-w-5rem max-h-5rem"-->
<!--            >-->
<!--        </div>-->

<!--        <Menubar ref="menu" id="overlay_menu" :model="items" :popup="true">-->
<!--            <template #end>-->
<!--                <InputText placeholder="Search" type="text" />-->
<!--            </template>-->
<!--        </Menubar>-->
<!--    </div>-->
</template>

<script setup>
import { ref } from "vue";
import Button from 'primevue/button';
import InputText from 'primevue/inputtext';
import Menu from 'primevue/menu';

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

const toggle = (event) => {
    menu.value.toggle(event);
};
</script>
<!--<script setup>-->
<!--    import {onBeforeMount, ref} from "vue";-->
<!--    import Button from 'primevue/button';-->
<!--    import InputText from 'primevue/inputtext';-->
<!--    import Menubar from 'primevue/menubar';-->
<!--    import OverlayPanel from 'primevue/overlaypanel';-->
<!--    import {useSecurityStore} from "@/store/security-store";-->

<!--    const securityStore = useSecurityStore();-->

<!--    const op = ref();-->
<!--    const user = ref(null);-->
<!--    const items = ref([-->
<!--        {-->
<!--            label: 'Home',-->
<!--            icon: 'pi pi-fw pi-home'-->
<!--        },-->
<!--        {-->
<!--            label: 'Account',-->
<!--            icon: 'pi pi-fw pi-user',-->
<!--            items: [-->
<!--                {-->
<!--                    label: 'Instellingen',-->
<!--                    icon: 'pi pi-fw pi-cog'-->
<!--                },-->
<!--                {-->
<!--                    label: 'Uitloggen',-->
<!--                    icon: 'pi pi-fw pi-power-off'-->
<!--                }-->
<!--            ]-->
<!--        },-->
<!--    ]);-->

<!--    onBeforeMount(async () => {-->
<!--        user.value = await securityStore.getUser();-->
<!--    });-->

<!--    const toggle = (event) => {-->
<!--        op.value.toggle(event);-->
<!--    }-->

<!--    function logout() {-->
<!--        securityStore.logout();-->

<!--        window.location.reload();-->
<!--    }-->


<!--</script>-->
