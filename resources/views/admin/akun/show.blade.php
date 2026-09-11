@extends('layouts.admin')

@section('title', 'Detail Admin')

@section('content')

    {{-- Header Halaman (mirip d-sm-flex di contoh) --}}
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-xl font-bold text-decora-text">Detail Admin</h1>
    </div>

    {{-- Row (mirip <div class="row">) --}}
    <div class="flex flex-wrap -mx-3">

        {{-- Col (mirip <div class="col-md-6">) --}}
        <div class="w-full md:w-1/2 px-3">

            {{-- Card (mirip <div class="card">) --}}
            <div class="bg-white border border-decora-cream-dark rounded-xl overflow-hidden">

                {{-- Card Header --}}
                <div class="px-5 py-3 border-b border-decora-cream-dark">
                    <h5 class="text-sm font-semibold text-decora-text mb-0">Informasi Admin</h5>
                </div>

                {{-- Card Body --}}
                <div class="p-5">
                    <table class="w-full text-sm">
                        <tbody class="divide-y divide-decora-cream-dark">
                            <tr class="odd:bg-decora-cream/30">
                                <th class="text-left px-5 py-3 w-40 text-decora-text/50 font-medium">ID</th>
                                <td class="px-5 py-3 text-decora-text">{{ $admin->id }}</td>
                            </tr>
                            <tr class="odd:bg-decora-cream/30">
                                <th class="text-left px-5 py-3 text-decora-text/50 font-medium">Nama</th>
                                <td class="px-5 py-3 text-decora-text">{{ $admin->nama }}</td>
                            </tr>
                            <tr class="odd:bg-decora-cream/30">
                                <th class="text-left px-5 py-3 text-decora-text/50 font-medium">Email</th>
                                <td class="px-5 py-3 text-decora-text">{{ $admin->email }}</td>
                            </tr>
                            <tr class="odd:bg-decora-cream/30">
                                <th class="text-left px-5 py-3 text-decora-text/50 font-medium">Dibuat Pada</th>
                                <td class="px-5 py-3 text-decora-text">{{ $admin->created_at->translatedFormat('d F Y, H:i') }}</td>
                            </tr>
                            <tr class="odd:bg-decora-cream/30">
                                <th class="text-left px-5 py-3 text-decora-text/50 font-medium">Diperbarui Pada</th>
                                <td class="px-5 py-3 text-decora-text">{{ $admin->updated_at->translatedFormat('d F Y, H:i') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                {{-- Card Footer (mirip <div class="card-footer">) --}}
                <div class="px-5 py-3 border-t border-decora-cream-dark flex items-center gap-3">
                    <a href="{{ route('admin.akun.index') }}" class="px-5 py-2 rounded-lg border border-decora-cream-dark text-decora-text/70 text-sm font-medium hover:bg-decora-cream-dark transition">
                        ← Kembali
                    </a>
                    <a href="{{ route('admin.akun.edit', $admin->id) }}" class="px-5 py-2 rounded-lg bg-decora-brown text-white text-sm font-medium hover:bg-decora-brown-dark transition">
                        Update
                    </a>
                </div>

            </div>
        </div>
    </div>

@endsection