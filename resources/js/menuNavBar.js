import {
    mdiMenu,
    mdiClockOutline,
    mdiCloud,
    mdiCrop,
    mdiAccount,
    mdiCogOutline,
    mdiEmail,
    mdiLogout,
    mdiThemeLightDark,
    mdiGithub
  } from '@mdi/js'
  
  export default [
    // {
    //   icon: mdiMenu,
    //   label: 'Sample menu',
    //   menu: [
    //     {
    //       icon: mdiClockOutline,
    //       label: 'Item One'
    //     },
    //     {
    //       icon: mdiCloud,
    //       label: 'Item Two'
    //     },
    //     {
    //       isDivider: true
    //     },
    //     {
    //       icon: mdiCrop,
    //       label: 'Item Last'
    //     }
    //   ]
    // },
    {
      isCurrentUser: true,
      menu: [
        {
          icon: mdiAccount,
          label: 'Mon profil',
          to: '/admin/edit-account-info'
        },
        // {
        //   icon: mdiCogOutline,
        //   label: 'Paramètres'
        // },
        // {
        //   icon: mdiEmail,
        //   label: 'Messages'
        // },
        {
          isDivider: true
        },
        {
          icon: mdiLogout,
          label: 'Déconnecter',
          isLogout: true
        }
      ]
    },
    {
      icon: mdiThemeLightDark,
      label: 'Light/Dark',
      isDesktopNoLabel: true,
      isToggleLightDark: true
    },

    {
      icon: mdiLogout,
      label: 'Déconnecter',
      isDesktopNoLabel: true,
      isLogout: true
    }
  ]