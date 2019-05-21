<?php
/**
 * auto generated file by PHPExtensionStubGenerator
 */

function SDL_Init($flags = NULL) {}
function SDL_InitSubSystem($flags) {}
function SDL_Quit() {}
function SDL_QuitSubSystem($flags) {}
function SDL_WasInit($flags) {}
function SDL_CreateWindow($title, $x, $y, $w, $h, $flags) {}
function SDL_CreateShapedWindow($title, $x, $y, $w, $h, $flags) {}
function SDL_DestroyWindow(SDL_Window $window) {}
function SDL_UpdateWindowSurface(SDL_Window $window) {}
function SDL_GetWindowTitle(SDL_Window $window) {}
function SDL_SetWindowTitle(SDL_Window $window, $title) {}
function SDL_GetWindowDisplayIndex(SDL_Window $window) {}
function SDL_ShowWindow(SDL_Window $window) {}
function SDL_HideWindow(SDL_Window $window) {}
function SDL_RaiseWindow(SDL_Window $window) {}
function SDL_MaximizeWindow(SDL_Window $window) {}
function SDL_MinimizeWindow(SDL_Window $window) {}
function SDL_RestoreWindow(SDL_Window $window) {}
function SDL_GetWindowSurface(SDL_Window $window) {}
function SDL_SetWindowDisplayMode(SDL_Window $window, SDL_DisplayMode $displaymode) {}
function SDL_GetWindowDisplayMode(SDL_Window $window, &$displaymode) {}
function SDL_GetWindowPixelFormat(SDL_Window $window) {}
function SDL_GetWindowID(SDL_Window $window) {}
function SDL_GetWindowFlags(SDL_Window $window) {}
function SDL_SetWindowIcon(SDL_Window $window, SDL_Surface $icon) {}
function SDL_SetWindowPosition(SDL_Window $window, $x, $y) {}
function SDL_GetWindowPosition(SDL_Window $window, &$x = NULL, &$y = NULL) {}
function SDL_SetWindowSize(SDL_Window $window, $x, $y) {}
function SDL_GetWindowSize(SDL_Window $window, &$x = NULL, &$y = NULL) {}
function SDL_SetWindowMinimumSize(SDL_Window $window, $x, $y) {}
function SDL_GetWindowMinimumSize(SDL_Window $window, &$x = NULL, &$y = NULL) {}
function SDL_SetWindowMaximumSize(SDL_Window $window, $x, $y) {}
function SDL_GetWindowMaximumSize(SDL_Window $window, &$x = NULL, &$y = NULL) {}
function SDL_SetWindowBordered(SDL_Window $window, $bordered) {}
function SDL_SetWindowFullscreen(SDL_Window $window, $flags) {}
function SDL_UpdateWindowSurfaceRects(SDL_Window $window, array $rects, $numrect = NULL) {}
function SDL_SetWindowGrab(SDL_Window $window, $grabbed) {}
function SDL_GetWindowGrab(SDL_Window $window) {}
function SDL_SetWindowBrightness(SDL_Window $window, $brightness) {}
function SDL_GetWindowBrightness(SDL_Window $window) {}
function SDL_GetWindowGammaRamp(SDL_Window $window, &$red, &$green, &$blue) {}
function SDL_IsShapedWindow(SDL_Window $window) {}
function SDL_SetWindowShape(SDL_Window $window, SDL_Surface $surface, SDL_WindowShapeMode $mode) {}
function SDL_GetShapedWindowMode(SDL_Window $window, &$shaped_mode) {}
function SDL_WINDOWPOS_UNDEFINED_DISPLAY($display) {}
function SDL_WINDOWPOS_CENTERED_DISPLAY($display) {}
function SDL_GetRevision() {}
function SDL_GetRevisionNumber() {}
function SDL_GetVersion(&$version) {}
function SDL_VERSION(&$version) {}
function SDL_VERSIONNUM($x, $y, $z) {}
function SDL_VERSION_ATLEAST($x, $y, $z) {}
function SDL_Delay($ms) {}
function SDL_CreateRenderer(SDL_Window $window, $index, $flags) {}
function SDL_DestroyRenderer($renderer) {}
function SDL_DestroyTexture($texture) {}
function SDL_SetRenderDrawColor($renderer, $r, $g, $b, $a) {}
function SDL_RenderDrawPoint($renderer, $x, $y) {}
function SDL_RenderClear($renderer) {}
function SDL_RenderCopy($renderer, $texture, SDL_Rect $srcrect, SDL_Rect $dstrect) {}
function SDL_RenderCopyEx($renderer, $texture, SDL_Rect $srcrect, SDL_Rect $dstrect, $angle, SDL_Point $center, $flip) {}
function SDL_RenderFillRect($renderer, SDL_Rect $rect) {}
function SDL_RenderPresent($renderer) {}
function SDL_CreateTextureFromSurface($renderer, SDL_Surface $surface) {}
function SDL_CreateRGBSurface($flags, $width, $height, $depth, $Rmask, $Gmask, $Bmask = NULL, $Amask = NULL) {}
function SDL_FreeSurface(SDL_Surface $surface) {}
function SDL_FillRect(SDL_Surface $surface, $rect, $color) {}
function SDL_FillRects(SDL_Surface $surface, $rects, $count, $color) {}
function SDL_MUSTLOCK(SDL_Surface $surface) {}
function SDL_LockSurface(SDL_Surface $surface) {}
function SDL_UnlockSurface(SDL_Surface $surface) {}
function SDL_LoadBMP_RW(SDL_RWops &$RWops, $freesrc) {}
function SDL_LoadBMP($path) {}
function SDL_UpperBlit(SDL_Surface $src, SDL_Rect $srcrect, SDL_Surface $dst, SDL_Rect &$dstrect = NULL) {}
function SDL_LowerBlit(SDL_Surface $src, SDL_Rect &$srcrect, SDL_Surface $dst, SDL_Rect &$dstrect) {}
function SDL_UpperBlitScaled(SDL_Surface $src, SDL_Rect $srcrect, SDL_Surface $dst, SDL_Rect &$dstrect = NULL) {}
function SDL_LowerBlitScaled(SDL_Surface $src, SDL_Rect &$srcrect, SDL_Surface $dst, SDL_Rect &$dstrect) {}
function SDL_SoftStretch(SDL_Surface $src, SDL_Rect $srcrect, SDL_Surface $dst, SDL_Rect &$dstrect = NULL) {}
function SDL_SaveBMP_RW(SDL_Surface $surface, SDL_RWops &$rwops, $freedst = NULL) {}
function SDL_SaveBMP(SDL_Surface $surface, $path) {}
function SDL_SetSurfaceRLE(SDL_Surface $surface, $flag) {}
function SDL_SetColorKey(SDL_Surface $surface, $flag, $key = NULL) {}
function SDL_GetColorKey(SDL_Surface $surface, &$key) {}
function SDL_SetSurfaceColorMod(SDL_Surface $surface, $red, $green, $blue) {}
function SDL_GetSurfaceColorMod(SDL_Surface $surface, &$red, &$green, &$blue) {}
function SDL_SetSurfaceAlphaMod(SDL_Surface $surface, $alpha) {}
function SDL_GetSurfaceAlphaMod(SDL_Surface $surface, &$alpha) {}
function SDL_SetSurfaceBlendMode(SDL_Surface $surface, $blendmmode) {}
function SDL_GetSurfaceBlendMode(SDL_Surface $surface, &$blendmode) {}
function SDL_SetClipRect(SDL_Surface $surface, $cliprect) {}
function SDL_GetClipRect(SDL_Surface $surface, &$cliprect) {}
function SDL_ConvertSurface(SDL_Surface $surface, SDL_PixelFormat $format, $flags = NULL) {}
function SDL_ConvertSurfaceFormat(SDL_Surface $surface, $format, $flags = NULL) {}
function SDL_ConvertPixels($height, $width, $src_format, SDL_Pixels $src, $src_pitch, $dst_format, SDL_Pixels $dst, $dst_pitch) {}
function SDL_RectEmpty(SDL_Rect $rect) {}
function SDL_RectEquals(SDL_Rect $rectA, SDL_Rect $rectB) {}
function SDL_HasIntersection(SDL_Rect $rectA, SDL_Rect $rectB) {}
function SDL_IntersectRect(SDL_Rect $rectA, SDL_Rect $rectB, &$result) {}
function SDL_UnionRect(SDL_Rect $rectA, SDL_Rect $rectB, &$result) {}
function SDL_IntersectRectAndLine(SDL_Rect $rect, &$X1, &$Y1, &$X2, &$Y2) {}
function SDL_EnclosePoints(array $point, $count, SDL_Rect $clip, &$rect) {}
function SDL_WaitEvent(SDL_Event &$event) {}
function SDL_PollEvent(SDL_Event &$event) {}
function SDL_ShowSimpleMessageBox($flags, $title, $message, SDL_Window $window = NULL) {}
function SDL_ShowMessageBox($messageboxdata, &$buttonid) {}
function SDL_GetPixelFormatName($format) {}
function SDL_PixelFormatEnumToMasks($format, &$bpp, &$Rmask, &$Gmask, &$Bmask, &$Amask) {}
function SDL_MasksToPixelFormatEnum($bpp, $Rmask, $Gmask, $Bmask, $Amask) {}
function SDL_AllocPalette($ncolors) {}
function SDL_FreePalette(SDL_Palette $palette) {}
function SDL_SetPaletteColors(SDL_Palette $palette, array $colors, $first = NULL, $ncolors = NULL) {}
function SDL_AllocFormat($format) {}
function SDL_FreeFormat(SDL_PixelFormat $format) {}
function SDL_SetPixelFormatPalette(SDL_PixelFormat $pixelformat, SDL_Palette $palette) {}
function SDL_MapRGB($pixelformat, $r, $g, $b) {}
function SDL_MapRGBA(SDL_PixelFormat $pixelformat, $r, $g, $b, $a) {}
function SDL_GetRGB($pixel, SDL_PixelFormat $format, &$r, &$g, &$b) {}
function SDL_GetRGBA($pixel, SDL_PixelFormat $format, &$r, &$g, &$b, &$a) {}
function SDL_CalculateGammaRamp($gamma, &$ramp) {}
function SDL_GetBasePath() {}
function SDL_GetPrefPath($org, $app) {}
function SDL_GL_ExtensionSupported($extension) {}
function SDL_GL_SetAttribute($attr, $value) {}
function SDL_GL_GetAttribute($attr, &$value) {}
function SDL_GL_CreateContext(SDL_Window $window) {}
function SDL_GL_DeleteContext(SDL_GLContext $GLcontext) {}
function SDL_GL_MakeCurrent(SDL_Window $window, SDL_GLContext $context = NULL) {}
function SDL_GL_GetCurrentWindow() {}
function SDL_GL_GetCurrentContext() {}
function SDL_GL_GetDrawableSize(SDL_Window $window, &$w, &$h) {}
function SDL_GL_SwapWindow(SDL_Window $window) {}
function SDL_GL_SetSwapInterval($interval) {}
function SDL_GL_GetSwapInterval() {}
function SDL_GetCPUCount() {}
function SDL_GetCPUCacheLineSize() {}
function SDL_HasRDTSC() {}
function SDL_HasAltiVec() {}
function SDL_HasMMX() {}
function SDL_Has3DNow() {}
function SDL_HasSSE() {}
function SDL_HasSSE2() {}
function SDL_HasSSE3() {}
function SDL_HasSSE41() {}
function SDL_HasSSE42() {}
function SDL_GetSystemRAM() {}
function SDL_SetError($error_message) {}
function SDL_GetError() {}
function SDL_ClearError() {}
function SDL_GetNumVideoDrivers() {}
function SDL_GetVideoDriver($driverIndex) {}
function SDL_VideoInit($drivername = NULL) {}
function SDL_VideoQuit() {}
function SDL_GetCurrentVideoDriver() {}
function SDL_GetNumVideoDisplays() {}
function SDL_GetDisplayName($displayIndex) {}
function SDL_GetDisplayBounds($displayIndex, &$rect) {}
function SDL_GetNumDisplayModes($displayIndex) {}
function SDL_GetDisplayMode($displayIndex, $modeIndex) {}
function SDL_GetDesktopDisplayMode($displayIndex) {}
function SDL_GetCurrentDisplayMode($displayIndex) {}
function SDL_GetClosestDisplayMode($displayIndex, SDL_DisplayMode $desired, &$closest = NULL) {}
function SDL_IsScreenSaverEnabled() {}
function SDL_EnableScreenSaver() {}
function SDL_DisableScreenSaver() {}
function SDL_GetPowerInfo(&$secs = NULL, &$pct = NULL) {}
function SDL_GetPlatform() {}
function SDL_GetKeyboardFocus() {}
function SDL_GetKeyboardState(&$numkeys = NULL, $allkeys = NULL) {}
function SDL_GetModState() {}
function SDL_SetModState($modstate) {}
function SDL_GetKeyFromScancode($scancode) {}
function SDL_GetScancodeFromKey($key) {}
function SDL_GetScancodeName($scancode) {}
function SDL_GetScancodeFromName($name) {}
function SDL_GetKeyName($key) {}
function SDL_GetKeyFromName($name) {}
function SDL_StartTextInput() {}
function SDL_IsTextInputActive() {}
function SDL_StopTextInput() {}
function SDL_SetTextInputRect(SDL_Rect $rect) {}
function SDL_HasScreenKeyboardSupport() {}
function SDL_IsScreenKeyboardShown(SDL_Window $window) {}
function SDL_CreateCursor($data, $mask, $w, $h, $hot_x, $hot_y) {}
function SDL_CreateSystemCursor($id) {}
function SDL_CreateColorCursor(SDL_Surface $surface, $hot_x, $hot_y) {}
function SDL_FreeCursor(SDL_Cursor $cursor) {}
function SDL_SetCursor(SDL_Cursor $cursor) {}
function SDL_GetCursor() {}
function SDL_GetDefaultCursor() {}
function SDL_ShowCursor($toggle) {}
function SDL_GetMouseFocus() {}
function SDL_GetMouseState(&$x = NULL, &$y = NULL) {}
function SDL_GetRelativeMouseState(&$x = NULL, &$y = NULL) {}
function SDL_WarpMouseInWindow(SDL_Window $window, $x, $y) {}
function SDL_SetRelativeMouseMode($enabled) {}
function SDL_GetRelativeMouseMode() {}
function SDL_CreateMutex() {}
function SDL_LockMutex(SDL_mutex $mutex) {}
function SDL_TryLockMutex(SDL_mutex $mutex) {}
function SDL_UnlockMutex(SDL_mutex $mutex) {}
function SDL_DestroyMutex(SDL_mutex $mutex) {}
function SDL_mutexP(SDL_mutex $mutex) {}
function SDL_mutexV(SDL_mutex $mutex) {}
function SDL_CreateSemaphore($value) {}
function SDL_SemWait(SDL_sem $semaphore) {}
function SDL_SemTryWait(SDL_sem $semaphore) {}
function SDL_SemPost(SDL_sem $semaphore) {}
function SDL_SemValue(SDL_sem $semaphore) {}
function SDL_SemWaitTimeout(SDL_sem $semaphore, $ms) {}
function SDL_DestroySemaphore(SDL_sem $semaphore) {}
function SDL_CreateCond() {}
function SDL_CondWait(SDL_cond $condition, SDL_mutex $mutex) {}
function SDL_CondSignal(SDL_cond $condition) {}
function SDL_CondBroadcast(SDL_cond $condition) {}
function SDL_CondWaitTimeout(SDL_cond $condition, SDL_mutex $mutex, $ms) {}
function SDL_DestroyCond(SDL_cond $condition) {}
function SDL_AllocRW() {}
function SDL_FreeRW(SDL_RWops $RWops) {}
function SDL_RWFromFile($path, $mode) {}
function SDL_RWFromFP($fp, $autoclose = NULL) {}
function SDL_RWFromMem(&$buf, $size) {}
function SDL_RWFromConstMem($buf, $size = NULL) {}
function SDL_RWsize(SDL_RWops $RWops) {}
function SDL_RWseek(SDL_RWops $RWops, $offset, $whence) {}
function SDL_RWtell(SDL_RWops $RWops) {}
function SDL_RWread(SDL_RWops $RWops, &$buffer, $size, $number = NULL) {}
function SDL_RWwrite(SDL_RWops $RWops, $buffer, $size = NULL, $number = NULL) {}
function SDL_RWclose(SDL_RWops $RWops) {}
function SDL_ReadU8(SDL_RWops $RWops) {}
function SDL_ReadLE16(SDL_RWops $RWops) {}
function SDL_ReadBE16(SDL_RWops $RWops) {}
function SDL_ReadLE32(SDL_RWops $RWops) {}
function SDL_ReadBE32(SDL_RWops $RWops) {}
function SDL_ReadLE64(SDL_RWops $RWops) {}
function SDL_ReadBE64(SDL_RWops $RWops) {}
function SDL_WriteU8(SDL_RWops $RWops, $value) {}
function SDL_WriteLE16(SDL_RWops $RWops, $value) {}
function SDL_WriteBE16(SDL_RWops $RWops, $value) {}
function SDL_WriteLE32(SDL_RWops $RWops, $value) {}
function SDL_WriteBE32(SDL_RWops $RWops, $value) {}
function SDL_WriteLE64(SDL_RWops $RWops, $value) {}
function SDL_WriteBE64(SDL_RWops $RWops, $value) {}