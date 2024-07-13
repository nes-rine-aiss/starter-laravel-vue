// src/utils.js
import Swal from 'sweetalert2'
import { router } from '@inertiajs/vue3'


export function useStatusChange() {

  async function changeStatus(url, id,itemName) {
    try {
        Swal.fire({
            text:`Déseriez-vous changer le status du ${itemName}?`,
            showDenyButton: false,
            showCancelButton: true,
            confirmButtonText: "Oui",
            confirmButtonColor: "#0066CC",
            cancelButtonText: "Non",
          }).then(async(result) => {
            if (result.isConfirmed) {
      await router.post(url.replace(':id', id),)  } else if (result.isDenied) {
        Swal.fire("Aucun changement", "", "info")
      }
    })
    } catch (error) {
      console.error('Error changing status:', error)
    }
  }

  return { changeStatus }
}

export function useDestroy() {

    function destroy(url, id, itemName,fetch) {
            Swal.fire({
      text:`Déseriez-vous supprimer ${itemName}?`,
      showDenyButton: false,
      showCancelButton: true,
      confirmButtonText: "Oui",
      confirmButtonColor: "#0066CC",
      cancelButtonText: "Non",
    }).then((result) => {
      if (result.isConfirmed) {
        router.delete(url.replace(':id', id), {
          onSuccess: (resp) => {
            console.log('a été supprimé avec succès:', resp)
fetch()
          },
        })
      } else if (result.isDenied) {
        Swal.fire("Aucun changement", "", "info")
      }
    })
  }

  return { destroy }
}
