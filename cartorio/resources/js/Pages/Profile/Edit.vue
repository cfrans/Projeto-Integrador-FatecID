<template>
  <form @submit.prevent="submit">
    <!-- Seus outros campos -->

    <div>
      <label for="foto">Foto de perfil</label>
      <input type="file" id="foto" @change="handleFileChange" />
      <img v-if="form.foto" :src="form.foto" alt="Foto atual" width="100" />
    </div>

    <button type="submit">Salvar</button>
  </form>
</template>

<script setup>
import { ref } from 'vue'
import { useForm } from '@inertiajs/inertia-vue3'
import { createClient } from '@supabase/supabase-js'

// // Config Supabase (pega do seu painel supabase)
// const supabaseUrl = 'https://SEU_SUPABASE_URL'
// const supabaseAnonKey = 'SUA_CHAVE_PUBLICA_ANONIMA'
// const supabase = createClient(supabaseUrl, supabaseAnonKey)

const supabaseUrl = import.meta.env.SUPABASE_URL
const supabaseAnonKey = import.meta.env.SUPABASE_API_KEY

const supabase = createClient(supabaseUrl, supabaseAnonKey)


const props = defineProps({
  user: Object,
})

const form = useForm({
  nome: props.user.nome || '',
  email: props.user.email || '',
  telefone: props.user.telefone || '',
  endereco: props.user.endereco || '',
  setor: props.user.setor || '',
  foto: props.user.foto || '', // URL da foto atual
})

async function uploadFoto(file) {
  const fileExt = file.name.split('.').pop()
  const fileName = `${crypto.randomUUID()}.${fileExt}`
  const filePath = `avatars/${fileName}`

  const { data, error } = await supabase.storage
    .from('public') // Nome do bucket no seu Supabase
    .upload(filePath, file)

  if (error) {
    alert('Erro ao enviar a foto: ' + error.message)
    return null
  }

  const { publicURL } = supabase.storage.from('public').getPublicUrl(filePath)
  return publicURL
}

async function handleFileChange(event) {
  const file = event.target.files[0]
  if (!file) return

  const url = await uploadFoto(file)
  if (url) {
    form.foto = url
  }
}

function submit() {
  form.post(route('profile.update'))
}
</script>
