 <!-- MODAL/popup CROPPER -->
 <div id="cropper-modal" class="fixed inset-0 bg-black/70 hidden items-center justify-center z-50">

     <div class="bg-white p-4 rounded-2xl shadow-xl w-full max-w-md">

         <!-- Container Crop -->
         <div class="w-full max-h-[60vh] flex items-center justify-center overflow-hidden">
             <img id="cropper-image" class="max-w-full max-h-[60vh] object-contain">
         </div>

         <!-- Action -->
         <div class="flex justify-end gap-3 mt-4">
             <button type="button" id="close-modal" class="px-4 py-2 bg-slate-200 rounded-lg text-sm font-semibold">
                 Cancel
             </button>

             <button type="button" id="crop-btn" class="px-4 py-2 bg-primary text-white rounded-lg text-sm font-bold">
                 Crop
             </button>
         </div>
     </div>
 </div>
